<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cursos;
use App\Models\Turmas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Inscricoes as ModelsInscricoes;

class Inscricoes extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $idCurso)
    {
        if($idCurso != null)
        {
            $curso = Cursos::find($idCurso);

            //Pega todas as inscricoes das turmas não canceladas
            $turmas = Turmas::where('id_curso', $idCurso)
            ->where('id_situacao_turma','<>','3')
            ->get();

            if($turmas != null)
            {
                $idsTurmas = [];

                foreach ($turmas as $turma) {
                    array_push($idsTurmas,$turma->id);
                }

                if($request->has('cpf'))
                {
                    $inscricoes = ModelsInscricoes::whereRaw("LOWER(cpf_servidor) like '%".strtolower($request->input('cpf'))."%'")
                    ->whereIn('id_turma',$idsTurmas)
                    ->orderBy('situacao_inscricao','DESC')
                    ->paginate(30);
    
                    return view('admin.inscricoes.index',compact(['inscricoes','curso']));
                }

                $inscricoes = ModelsInscricoes::whereIn('id_turma',$idsTurmas)
                ->orderBy('situacao_inscricao','DESC')
                ->paginate(30);
                
                return view('admin.inscricoes.index',compact(['inscricoes','curso']));

            }

            Session::flash('error','Não há inscrições pois não há turmas cadastradas para este curso ou todas as turmas foram canceladas');
            return redirect()->route('listar.cursos', ['idCurso'=>$curso->id]);
        }

        return abort(404);
    }

    public function aprovarInscricao($idCurso,$idInscricao)
    {
        if($idCurso != null && $idInscricao != null)
        {
            $curso = Cursos::find($idCurso);
            $inscricao = ModelsInscricoes::find($idInscricao);

            if($inscricao != null && $curso != null)
            {
                $inscricao->situacao_inscricao = 'confirmada';
                $inscricao->update();

                Session::flash('success','Inscrição aprovada com sucesso!');
                return redirect()->route('index.admin.inscricao', ['idCurso'=>$curso->id]);
            }

            Session::flash('error','Inscrição não encontrada!');
            return redirect()->route('index.admin.inscricao', ['idCurso'=>$curso->id]);

        }
        return abort(404);
    }

    public function cancelarInscricao($idCurso,$idInscricao)
    {
        if($idCurso != null && $idInscricao != null)
        {
            $curso = Cursos::find($idCurso);
            $inscricao = ModelsInscricoes::find($idInscricao);

            if($inscricao != null && $curso != null)
            {
                $inscricao->situacao_inscricao = 'cancelada';
                $inscricao->update();

                Session::flash('success','Inscrição cancelada com sucesso!');
                return redirect()->route('index.admin.inscricao', ['idCurso'=>$curso->id]);
            }

            Session::flash('error','Inscrição não encontrada!');
            return redirect()->route('index.admin.inscricao', ['idCurso'=>$curso->id]);

        }
        return abort(404);

    }
}
