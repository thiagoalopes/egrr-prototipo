<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Turmas;
use App\Models\Inscricoes;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Frequencia as ModelsFrequencia;

class Frequencia extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $idTurma)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $dataAula = $request->input('data_aula');
            $turma = Turmas::find($idTurma);
            $datas = [];

            if($turma != null)
            {
                //Verifica se a turma esta fechada
                if($turma->situacao->situacao != 'Fechada')
                {
                    Session::flash('error','A Turma ainda não está fechada!');
                    return redirect()->route('listar.turmas',['idCurso'=>$turma->curso->id]);
                }

                $dataInicio = new DateTime($turma->data_inicio);
        
                $dataTermino = new DateTime($turma->data_termino);
                $dataTermino = $dataTermino->modify( '+1 day' );
        
                $intervalo = new DateInterval('P1D');
                $periodo = new DatePeriod($dataInicio, $intervalo ,$dataTermino);
        
        
                foreach ($periodo as $data) {
                    array_push($datas, $data);
                }


                if($dataAula != null && strtotime($dataAula))
                {
                    $inscricoes = Inscricoes::where('id_turma', $idTurma)
                    ->get();
                    
                    if($inscricoes != null)
                    {
                        $idsFrequenciasInscricoesCanceladas = [];

                        //Cadastra todos os servidores inscritos aprovados na tb frequencia na turma no dia da aula selecionada
                        foreach ($inscricoes as $inscricao) {
                            
                            $frequencia = ModelsFrequencia::where('id_turma', $idTurma)
                            ->where('id_servidor', $inscricao->id_servidor)
                            ->where('data_aula', $dataAula)
                            ->first();

                            if($frequencia == null && $inscricao->situacao_inscricao = 'confirmada')
                            {
                                ModelsFrequencia::create([
                                    'id_inscricao'=>$inscricao->id,
                                    'id_servidor'=>$inscricao->servidor->id,
                                    'id_secretaria_servidor'=>$inscricao->servidor->secretaria->id,
                                    'id_curso'=>$inscricao->turma->curso->id,
                                    'id_turma'=>$inscricao->turma->id,
                                    'id_professor'=>$inscricao->turma->curso->professor->id,
                                    'nome_servidor'=>$inscricao->nome_servidor,
                                    'sigla_secretaria'=>$inscricao->sigla,
                                    'nome_curso'=>$inscricao->turma->curso->nome,
                                    'descricao_turma'=>$inscricao->turma->descricao_turma,
                                    'nome_professor'=>$inscricao->turma->curso->professor->nome,
                                    'data_aula'=>$dataAula,
                                ]);
                            }
                            elseif($frequencia != null && $inscricao->situacao_inscricao == 'cancelada')
                            {
                                array_push($idsFrequenciasInscricoesCanceladas, $frequencia->id);
                            }
                        }

                        $frequencias = ModelsFrequencia::where('id_turma', $idTurma)
                        ->where('data_aula', $dataAula);
                        if($idsFrequenciasInscricoesCanceladas != null && count($idsFrequenciasInscricoesCanceladas) > 0)
                        {
                            $frequencias=$frequencias->whereNotIn('id', $idsFrequenciasInscricoesCanceladas);
                        }
                        
                        $frequencias = $frequencias->orderBy('nome_servidor', 'ASC')->get();

                        if($frequencias != null)
                        {
                            return view('admin.frequencias.index', compact(['frequencias','turma','datas']));

                        }
                        return abort(404);
                    }
                }
                elseif($dataAula == null)
                {
                    return view('admin.frequencias.index', compact(['turma','datas']));
                }

                Session::flash('error','Data inválida!');
                return redirect()->route('frequencia.turmas',['idTurma'=>$turma->id]);
            }

            return abort(404);
        }
        return abort(403);
    }

    public function downloadFrequencia(Request $request)
    { 
        if($request->input('data_aula') != null && $request->input('id_turma') != null)
        {
            $dataAula = $request->input('data_aula');
            $idTurma = $request->input('id_turma');
            $turma = Turmas::find($request->input('id_turma'));

            if($turma != null)
            {
                if(strtotime($dataAula))
                {
                    $frequencias = ModelsFrequencia::where('id_turma', $idTurma)
                    ->where('data_aula', $dataAula)
                    ->orderBy('nome_servidor', 'ASC')
                    ->get();
    
                    if($frequencias == null)
                    {
                        Session::flash('error','Não há frequências disponivéis');
                        return redirect()->back();
                    }
            
                    $file = PDF::loadView('admin.frequencias.frequencia',compact(['frequencias','turma','dataAula']));
                    Storage::put("temp/frequencia_".str_replace(' ','_',strtolower($turma->descricao_turma)).".pdf",
                         $file->setPaper('a4', 'portrait')->output());

                    return response()->file(storage_path()."/app/temp/frequencia_".str_replace(' ','_',strtolower($turma->descricao_turma)).".pdf",
                     ["Content-Disposition"=>"attachment;filename=frequencia_".str_replace(' ','_',strtolower($turma->descricao_turma)).".pdf",
                    "Content-Type"=>'application/pdf'
                     ])->deleteFileAfterSend();
                }
                Session::flash('error','Data inválida!');
                return redirect()->back();
            }
            Session::flash('error','turma não encontrada');
            return redirect()->back();
        }
        return abort(404);
    }

    public function dadosFrequencia($idTurma, $idFrequencia)
    {
        return 'ok';
    }

    public function atualizarPresenca(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->input('id_frequencia') != null && $request->input('ispresente') != null)
            {
                $frequencia = ModelsFrequencia::find($request->input('id_frequencia'));
                if($frequencia != null)
                {
                    $frequencia->ispresente = $request->input('ispresente');
                    $frequencia->update();

                    return response()->json(['result'=>'success'], 200);
                }
            }
            return response()->json(['result'=>'fail'], 400);
        }
        return abort(403);
    }
}
