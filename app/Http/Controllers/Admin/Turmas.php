<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\SituacaoTurmas;
use App\Http\Controllers\Controller;
use App\Models\Cursos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Turmas as ModelsTurmas;
use Illuminate\Support\Facades\Session;

class Turmas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    if($request->has('descricao'))
                    {

                        $turmas = ModelsTurmas::whereRaw("LOWER(descricao_turma) like '%".strtolower($request->input('descricao'))."%'")
                        ->where('id_curso', $request->input('idCurso'))->paginate(15);
                        return view('admin.turma.index', compact(['turmas','curso']));
                    }

                    $turmas = ModelsTurmas::where('id_curso', $request->input('idCurso'))->paginate(15);
                    return view('admin.turma.index', compact(['turmas','curso']));
                }

                return abort(400);
            }

            return abort(404);
        }

        return abort(403);
    }

    public function cadastro(Request $request)
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $situacoesTurmas = SituacaoTurmas::all();
                    return view('admin.turma.cadastro', compact(['situacoesTurmas', 'curso']));
                }

                return abort(404);
            }

            return abort(404);
        }

        return abort(403);
    }

    public function salvar(Request $request)
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {

            if($request->has('id_curso'))
            {
                $validated = $request->validate([
                    'id_curso'=>'required',
                    'id_situacao_turma'=>'required',
                    'descricao_turma'=>'required|max:128',
                    'total_vagas_turma'=>'required|max:4',
                    'data_inicio'=>'required|date|date_format:d-m-Y',
                    'data_termino'=>'required|date|date_format:d-m-Y',
                    'horario_inicio_aula'=>'required|date_format:H:i',
                    'horario_termino_aula'=>'required|date_format:H:i',
                ]);

                $curso = Cursos::find($request->input('id_curso'));

                if($curso != null)
                {
                    $totalDeVagasCurso = Cursos::find($validated['id_curso'])->total_vagas;
                    $turmas = ModelsTurmas::where('id_curso', $validated['id_curso'])->get();
    
                    $totalVagasTurmasCadastradas = 0;
    
                    foreach ($turmas as $turma) {
                        $totalVagasTurmasCadastradas += $turma->total_vagas_turma;
                    }
    
                    if(($totalVagasTurmasCadastradas + $validated['total_vagas_turma']) >= $totalDeVagasCurso)
                    {
                        Session::flash(
                        'error','Vagas do curso insuficiente. Totais de vagas: Informado' . $totalDeVagasCurso . 
                        ' - Cadastradas ' . $totalVagasTurmasCadastradas . ' - Restantes ' . ($totalDeVagasCurso - ($totalVagasTurmasCadastradas + $validated['total_vagas_turma']))<=0?0:($totalDeVagasCurso - ($totalVagasTurmasCadastradas + $validated['total_vagas_turma'])));
                        return redirect()->route('cadastro.turmas', ['idCurso'=>$validated['id_curso']]);
                    }
    
                    ModelsTurmas::create($validated);
                    Session::flash('success','Cadastrado com sucesso!');
                    return redirect()->route('cadastro.turmas', ['idCurso'=>$validated['id_curso']]);
                }

                return abort(404);
            }

            return abort(404);

        }

        return abort(403);
    }

    public function detalhes(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso') && $request->has('idTurma'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                $situacoesTurmas = SituacaoTurmas::all();

                $turma = ModelsTurmas::where('id',$request->input('idTurma'))
                ->where('id_curso', $request->input('idCurso'))->first();

                if($turma != null)
                {
                    return view('admin.turma.show', compact(['situacoesTurmas','turma','curso']));
                }

                return abort(404);
            }

            return redirect()->back();
        }
        return abort(403);
    }

    public function editar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso') && $request->has('idTurma'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $turma = ModelsTurmas::where('id_curso', $request->input('idCurso'))
                    ->where('id', $request->input('idTurma'))->first();

                    if($turma != null)
                    {
                        $situacoesTurmas = SituacaoTurmas::all();
                        return view('admin.turma.editar', compact(['turma','situacoesTurmas','curso']));
                    }

                    return redirect()->route('listar.turmas', ['idCurso'=>$curso->id]);
                }

                return abort(404);
            }

            return abort(404);
        }

        return abort(403);
    }

    public function atualizar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso') && $request->has('idTurma'))
            {
                $validated = $request->validate([
                    'id_situacao_turma'=>'required',
                    'descricao_turma'=>'required|max:128',
                    'total_vagas_turma'=>'required|max:4',
                    'data_inicio'=>'required|date|date_format:d-m-Y',
                    'data_termino'=>'required|date|date_format:d-m-Y',
                    'horario_inicio_aula'=>'required|date_format:H:i',
                    'horario_termino_aula'=>'required|date_format:H:i',
                ]);

                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $turma = ModelsTurmas::find($request->input('idTurma'));

                    if($turma != null)
                    {

                        $turma->update($validated);
                        Session::flash('success','Atualizado com sucesso!');
                        return redirect()->route('editar.turmas', ['idCurso'=>$curso->id, 'idTurma'=>$turma->id]);
                    }

                    return redirect()->back();
                }

                return redirect()->back();
    
            }

            return abort(404);
        }

        return abort(403);
    }

}
