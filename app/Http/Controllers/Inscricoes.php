<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\Turmas;
use Illuminate\Http\Request;

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

    public function inscricao(Request $request, $idTurma)
    {
        $turma = Turmas::find($idTurma);

        if($turma != null)
        {
            return 'ok';
        }

        return abort(404);
    }
}
