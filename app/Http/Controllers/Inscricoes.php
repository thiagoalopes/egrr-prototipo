<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cursos;
use App\Models\Turmas;
use App\Models\Servidor;
use Illuminate\Http\Request;
use App\Models\SecretariaServidores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Inscricoes as ModelsIncricoes;

class Inscricoes extends Controller
{
    public function __construct()
    {
        //Tudo é protegido pela guard auth
        //só visualiza as rotas se o usuário estiver logado
        $this->middleware('auth');
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
                unset($validated['id_curso']);

                $validated['id_servidor'] = Servidor::where('cpf', Auth::user()->cpf)->first()->id ;
                $validated['codigo_inscricao'] = Auth::user()->cpf . Carbon::now()->timestamp;
                $validated['situacao_inscricao'] = 'pendente';
                $validated['data_situacao'] = Carbon::now();
        
                $inscricao = ModelsIncricoes::create($validated);
        
                return $inscricao;
            }
            return abort(404);
        }
        return abort(404);
    }
}
