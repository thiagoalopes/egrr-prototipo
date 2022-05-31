<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\Cursos;
use App\Models\Gestores;
use App\Models\Frequencia;
use App\Models\Inscricoes;
use Illuminate\Http\Request;
use App\Models\ConteudosCursos;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificados as ModelsCertificados;

class Certificados extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($idCurso)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $curso = Cursos::find($idCurso);

            if($curso != null)
            {
                $turmas = $curso->turmas;

                $idsTurmas = [];
                foreach ($turmas as $turma) {
                array_push($idsTurmas, $turma->id);
                }

                $inscricoes = Inscricoes::whereIn('id_turma', $idsTurmas)
                ->where('situacao_inscricao','confirmada')
                ->get();

                $situacoesAlunos = [];

                foreach ($inscricoes as $inscricao) {

                    $presencas = 0;
                    $horaInicioAula = DateTime::createFromFormat('H:i:s', $inscricao->turma->horario_inicio_aula);
                    $horaTerminoAula = DateTime::createFromFormat('H:i:s', $inscricao->turma->horario_termino_aula);
                    $duracaoAula = $horaTerminoAula->diff($horaInicioAula)->format('%h');
                    $cargaHorariaCumprida = 0;
                    $CargaHorariaCurso = $inscricao->turma->curso->carga_horaria;
                    $aproveitamento = 0;

                    $frequencias = Frequencia::where('id_turma', $idCurso)
                    ->where('id_servidor', $inscricao->id_servidor)
                    ->get();

                    foreach ($frequencias as $frequencia) {
                        if($frequencia->ispresente)
                        {
                            $presencas++;
                        }
                    }

                    $cargaHorariaCumprida = $duracaoAula * $presencas;
                    $aproveitamento = $cargaHorariaCumprida * 100 / $CargaHorariaCurso;

                    $certificado = ModelsCertificados::where('id_servidor', $inscricao->id_servidor)
                    ->where('id_curso', $inscricao->turma->curso->id)
                    ->first();

                    array_push($situacoesAlunos,[
                        'id_inscricao'=>$inscricao->id,
                        'nome'=>$inscricao->nome_servidor,
                        'carga_horaria_cumprida'=>$cargaHorariaCumprida,
                        'aproveitamento'=>$aproveitamento.'%',
                        'situacao'=>$aproveitamento>=67?'A':'R',
                        'hascertificado'=>$certificado!=null&&$certificado->count()>0?true:false
                    ]);
                }

                return view('certificado.certificados',compact(['situacoesAlunos','curso']));

            }
        }
        return abort(403);
    }

    public function liberarCertificado($idInscricao)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $inscricao = Inscricoes::find($idInscricao);

            if($inscricao != null)
            {

                $certificado = ModelsCertificados::where('id_servidor', $inscricao->id_servidor)
                ->where('id_curso', $inscricao->turma->curso->id)
                ->first();

                if($certificado != null && $certificado->count() > 0)
                {
                    Session::flash('success','Este certificado já foi liberado!');
                    return redirect()->route('certificados',['idCurso'=>$inscricao->turma->curso->id]);
                }

                $gestores = Gestores::orderBy('id','DESC')->first();
                $conteudos = ConteudosCursos::where('id_curso', $inscricao->turma->curso->id)->get();

                $presencas = 0;
                $horaInicioAula = DateTime::createFromFormat('H:i:s', $inscricao->turma->horario_inicio_aula);
                $horaTerminoAula = DateTime::createFromFormat('H:i:s', $inscricao->turma->horario_termino_aula);
                $duracaoAula = $horaTerminoAula->diff($horaInicioAula)->format('%h');
                $cargaHorariaCumprida = 0;
                $CargaHorariaCurso = $inscricao->turma->curso->carga_horaria;
                $aproveitamento = 0;

                $frequencias = Frequencia::where('id_turma', $inscricao->turma->curso->id)
                ->where('id_servidor', $inscricao->id_servidor)
                ->get();

                foreach ($frequencias as $frequencia) {
                    if($frequencia->ispresente)
                    {
                        $presencas++;
                    }
                }

                $cargaHorariaCumprida = $duracaoAula * $presencas;
                $aproveitamento = $cargaHorariaCumprida * 100 / $CargaHorariaCurso;

                if($gestores != null && $gestores->count() >0)
                {
                    $certificado = ModelsCertificados::create([
                        'id_inscricao'=>$inscricao->id,
                        'id_servidor'=>$inscricao->id_servidor,
                        'nome_servidor'=>$inscricao->nome_servidor,
                        'cpf'=>$inscricao->cpf_servidor,
                        'matricula'=>$inscricao->matricula,
                        'tipo_vinculo'=>$inscricao->tipo_vinculo,
                        'curso'=>$inscricao->nome_curso,
                        'professor'=>$inscricao->turma->curso->professor->nome,
                        'data_inicio'=>$inscricao->turma->curso->data_inicio,
                        'data_termino'=>$inscricao->turma->curso->data_termino,
                        'carga_horaria'=>$inscricao->turma->curso->carga_horaria,
                        'aproveitamento'=>$aproveitamento,
                        'id_curso'=>$inscricao->turma->curso->id,
                        'diretor_egrr'=>$gestores->nome_diretor_egrr,
                        'assinatura_diretor_egrr'=>$gestores->imagem_assinatura_diretor,
                        'secretario_segad'=>$gestores->nome_secretario,
                        'conteudos'=> $conteudos->toArray(),
                        'assinatura_secretario_segad'=>$gestores->imagem_assinatura_diretor,
                        'data_emissao'=>Carbon::now(),
                        'id_servidor_emitente'=>Auth::user()->id,
                    ]);

                    Session::flash('success','Certificado liberado');
                    return redirect()->route('certificados',['idCurso'=>$inscricao->turma->curso->id]);
                }
                Session::flash('error','Assinaturas não informadas');
                return redirect()->route('certificados',['idCurso'=>$inscricao->turma->curso->id]);
            }
            return abort(404);
        }
        return abort(403);
    }
    
    public function certificadosServidor()
    {
        $certificados = ModelsCertificados::where('id_curso');
    }

    public function gerarCertificado()
    {
        $usuario = Auth::user();
        
        $file = PDF::loadView('certificado.layout',compact(['usuario']));

        Storage::put("temp/certificado_{$usuario->cpf}.pdf", $file->setPaper('a4', 'landscape')->output());

        return response()->file(storage_path()."/app/temp/certificado_{$usuario->cpf}.pdf", ["Content-Disposition"=>"inline;filename=certificado_{$usuario->cpf}",
            "Content-Type"=>'application/pdf'
        ])->deleteFileAfterSend();

    }
}
