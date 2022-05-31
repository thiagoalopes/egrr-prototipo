<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cursos;
use App\Models\Turmas;
use App\Models\Servidor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SecretariaServidores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Inscricoes as ModelsIncricoes;


class Inscricoes extends Controller
{
    public function __construct()
    {
        //Tudo é protegido pela guard auth
        //só visualiza as rotas se o usuário estiver logado
        $this->middleware('auth')->except('index');
        $this->middleware('isServidorCadastrado')->except('index');
        $this->middleware('prevent-back-history')->except('emitir');
    }

    public function index($idCurso)
    {
        $curso = Cursos::find($idCurso);
        $turmas = Turmas::where('id_curso', $idCurso)
        ->whereNotIn('id_situacao_turma', [2,3]) // 2-Turma Fechada 3-Turma Cancelada
        ->get();
        
        $hasVaga = true;

        if($turmas != null)
        {
            foreach ($turmas as $turma) {
                
                if(!$this->hasVagas($turma->id))
                {
                    Session::flash('success','Ops! todas as vagas foram preenchidas no momento.');
                    $hasVaga=false;
                    break;
                }
            }
            return view('inscricoes.index', compact(['curso','turmas','hasVaga']));
        }

        return abort(404);
    }

    public function inscricao(Request $request, $idCurso, $idTurma)
    {
        $turma = Turmas::find($idTurma);
        $curso = Cursos::find($idCurso);
        $servidor = Servidor::where('cpf', Auth::user()->cpf)->first();
        $secretarias = SecretariaServidores::all();

        if(!$this->hasVagas($turma->id))
        {
            Session::flash('success','Ops! todas as vagas foram preenchidas no momento.');
            return redirect()->route('home.inscricao',['idCurso'=>$turma->id_curso]);
        }
        
        if($servidor != null)
        {
            if($turma != null && $curso != null)
            {
                if($this->isInscrito($idTurma))
                {
                    Session::flash('success','Você já se inscreveu neste curso anteriormente!');
                    return redirect()->route('home.inscricao',['idCurso'=>$turma->id_curso]);
                }

                return view('inscricoes.inscricao', compact(['curso','turma','servidor','secretarias']));
            }

            return abort(404);
        }

        Session::flash('error','Seus dados estão desatualizados, por favor, atualize.');
        return redirect()->route('cadastro.servidor');

    }

    public function salvar(Request $request)
    {

        $validated = $request->validate([
            'termo_aceito'=>'required|in:1',
            'id_curso'=>'required',
            'id_turma'=>'required',
        ]);

        $curso = Cursos::find($validated['id_curso']);

        if($curso != null)
        {
            $turma = Turmas::find($validated['id_turma']);

            if($turma != null && $turma->id_curso == $validated['id_curso'])
            {
                if($this->isInscrito($validated['id_turma']))
                {
                    Session::flash('success','Você já se inscreveu neste curso anteriormente!');
                    return redirect()->route('home.inscricao',['idCurso'=>$turma->id_curso]);
                }

                unset($validated['id_curso']);

                $validated['id_servidor'] = Auth::user()->id ;
                $validated['codigo_inscricao'] = Carbon::now()->timestamp;
                $validated['situacao_inscricao'] = 'pendente';
                $validated['nome_servidor'] = Auth::user()->nome;
                $validated['matricula'] = Auth::user()->matricula;
                $validated['tipo_vinculo'] = Auth::user()->tipo_vinculo;
                $validated['cpf_servidor'] = Auth::user()->cpf;
                $validated['secretaria'] = Auth::user()->secretaria->secretaria;
                $validated['sigla'] = Auth::user()->secretaria->sigla;
                $validated['nome_curso'] = $curso->nome;
                $validated['data_situacao'] = Carbon::now();
        
                $inscricao = ModelsIncricoes::create($validated);
        
                return redirect()->route('sucesso.inscricao',['idCurso'=>$curso->id,'codigoInscricao'=>$inscricao->codigo_inscricao]);
            }
            return abort(404);
        }
        return abort(404);
    }

    public function sucesso($codigoInscricao, $idCurso)
    {
        Session::flash('success','Sua inscrição foi realizada com sucesso! Aguarde a confirmação pela EGRR');
        return view('inscricoes.sucesso', compact(['idCurso','codigoInscricao']));
    }

    public function emitir($codigoInscricao, $idCurso)
    {
        $inscricao = ModelsIncricoes::where('codigo_inscricao',$codigoInscricao)->first();

        if($inscricao == null)
        {
            return redirect()->route('home.inscricao',['idCurso'=>$idCurso]);
        }

        $file = PDF::loadView('inscricoes.comprovante',compact(['inscricao']));

        Storage::put("temp/comprovante_inscricao_{$inscricao->servidor->cpf}.pdf", $file->setPaper('a4', 'portrait')->output());

        info('Servidor '.$inscricao->servidor->nome.' emitiu o comprovante.');

        return response()->file(storage_path()."/app/temp/comprovante_inscricao_{$inscricao->servidor->cpf}.pdf", ["Content-Disposition"=>"attachment;filename=comprovante_{$inscricao->servidor->cpf}",
            "Content-Type"=>'application/pdf'
        ])->deleteFileAfterSend();
    }

    private function isInscrito($idTurma)
    {
        if($idTurma != null)
        {
            $inscricoes = Auth::user()->inscricoes;
            
            foreach ($inscricoes as $inscricao) {
                $turma = $inscricao->turma;
                
                if($idTurma == $turma->id)
                {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    private function hasVagas($idTurma)
    {
        $turma = Turmas::find($idTurma);
        $inscricoesDaTurma = ModelsIncricoes::where('situacao_inscricao','<>','cancelada')
        ->where('id_turma', $turma->id)->get(); 
        $curso = $turma->curso;

        $turmasNaoCanceladas = Turmas::where('id_curso', $curso->id)
        ->where('id_situacao_turma','<>','3')
        ->get();

        $totalVagasTurmasCadastradas = 0;
        $idsTurmas = [];

        //Totaliza as vagas de todas as turmas do curso
        foreach ($turmasNaoCanceladas as $turmaAux) {
            $totalVagasTurmasCadastradas += $turmaAux->total_vagas_turma;
            array_push($idsTurmas, $turmaAux->id);
        }

        $inscricoes = ModelsIncricoes::orWhere('situacao_inscricao','pendente')
        ->orWhere('situacao_inscricao','confirmada')
        ->whereIn('id_turma',$idsTurmas)
        ->get();
        
        //Totaliza as inscricoes realizadas para a turmas
        $totalDeInscricoes = $inscricoes->count();

        //Valida se há vagas disponíveis caso a turma não esteja cancelada
        if($turma->total_vagas_turma <= $inscricoesDaTurma->count() || $curso->total_vagas <= $totalDeInscricoes)
        {
            return false;
        }

        return true;
    }

    public function inscricoesServidores()
    {
        $inscricoes = Auth::user()->inscricoes;
        return view('servidor.inscricoes',compact(['inscricoes']));
    }
}
