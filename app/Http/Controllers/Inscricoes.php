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

        if($turmas != null)
        {
            return view('inscricoes.index', compact(['curso','turmas']));
        }

        return abort(404);
    }

    public function inscricao(Request $request, $idCurso, $idTurma)
    {
        
        $turma = Turmas::find($idTurma);
        $curso = Cursos::find($idCurso);
        $servidor = Servidor::where('cpf', Auth::user()->cpf)->first();
        $secretarias = SecretariaServidores::all();
        
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

                $validated['id_servidor'] = Servidor::where('cpf', Auth::user()->cpf)->first()->id ;
                $validated['codigo_inscricao'] = Carbon::now()->timestamp;
                $validated['situacao_inscricao'] = 'pendente';
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
        Session::flash('success','Sua inscrição foi realizada com sucesso!');
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

    public function inscricoesServidores()
    {
        $inscricoes = Auth::user()->servidor->inscricoes;
        return view('servidor.inscricoes',compact(['inscricoes']));
    }
}
