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
                $turmas = ModelsTurmas::paginate(15);
                return view('admin.turma.index', compact(['turmas']));
            }

            return abort(400);
        }

        return abort(403);
    }

    public function cadastro(Request $request)
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso'))
            {
                $situacoesTurmas = SituacaoTurmas::all();
                return view('admin.turma.cadastro', compact(['situacoesTurmas']));
            }

            return abort(400);
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
                    'data_inicio'=>'required|date_format:d/m/Y',
                    'data_termino'=>'required|date_format:d/m/Y',
                    'horario_inicio_aula'=>'required|date_format:H:i:s',
                    'horario_termino_aula'=>'required|date_format:H:i:s',
                ]);

                //dd($validated['id_curso']);

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

            return abort(400);

        }

        return abort(403);
    }

    public function detalhes(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso'))
            {
                //$situacoes = SituacaesCursos::all();
                //$professores = Professores::all();
                //$curso = ModelsCursos::find($request->input('idCurso'));
                //return view('admin.curso.show', compact(['curso','professores','situacoes']));
            }

            return redirect()->back();
        }
        return abort(403);
    }

    public function editar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {

            if($request->has('idCurso'))
            {
              //  $situacoes = SituacaesCursos::all();
               // $professores = Professores::all();
              //  $curso = ModelsCursos::find($request->input('idCurso'));
              //  return view('admin.curso.editar', compact(['curso','professores','situacoes']));
            }

            return redirect()->back();
        }

        return abort(403);
    }

    public function atualizar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso'))
            {
                $validated = $request->validate([
                    'imagem'=>'nullable|file|mimes:jpg,jpeg,png|max:1024',
                    'nome'=>'required|max:128',
                    'descricao'=>'required|max:500',
                    'carga_horaria'=>'required|string|max:4',
                    'total_vagas'=>'required',
                    'id_professor'=>'required',
                    'id_situacao_curso'=>'required',
                    'data_inicio'=>'required|date_format:d/m/Y',
                    'data_termino'=>'required|date_format:d/m/Y',
                    'endereco_curso'=>'required',
                ]);

                if($request->hasFile('imagem'))
                {
               //     $validated['imagem'] = Storage::disk('imagens')->put('assets/img/cursos', $request->file('imagem'));
                }

               // $curso = ModelsCursos::find($request->input('idCurso'));

               // if($curso != null)
              //  {
                //    $curso->update($validated);
                 //   Session::flash('success','Atualizado com sucesso!');
                //    return redirect()->route('editar.cursos', ['idCurso'=>$curso->id]);
               // }

                return redirect()->back();
    
            }

            return abort(400);
        }

        return abort(403);
    }

}
