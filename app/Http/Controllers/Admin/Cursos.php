<?php

namespace App\Http\Controllers\Admin;

use App\Models\Professores;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Cursos as ModelsCursos;
use App\Models\SituacaesCursos;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Cursos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $cursos = ModelsCursos::paginate(15);
            return view('admin.curso.index', compact(['cursos']));
        }

        return abort(403);
    }

    public function cadastro()
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $professores = Professores::all();
            return view('admin.curso.cadastro', compact(['professores']));
        }

        return abort(403);
    }

    public function salvar(Request $request)
    {

        if(Gate::allows('isAdminCurso', Auth::user()))
        {

            $validated = $request->validate([
                'imagem'=>'nullable|file|mimes:jpg,jpeg,png|max:1024',
                'nome'=>'required|max:128',
                'descricao'=>'required|max:500',
                'carga_horaria'=>'required|numeric|max:4',
                'total_vagas'=>'required',
                'id_professor'=>'required',
                'data_inicio'=>'required|date_format:d/m/Y',
                'data_termino'=>'required|date_format:d/m/Y',
                'endereco_curso'=>'required',
            ]);

            if($request->hasFile('imagem'))
            {
                $validated['imagem'] = Storage::disk('imagens')->put('assets/img/cursos', $request->file('imagem'));
            }

            //Situação Confirmado
            $validated['id_situacao_curso'] = 1;

            ModelsCursos::create($validated);

            Session::flash('success','Cadastrado com sucesso!');
            return redirect()->route('cadastro.cursos');
        }

        return abort(403);
    }

    public function detalhes(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso'))
            {
                $situacoes = SituacaesCursos::all();
                $professores = Professores::all();
                $curso = ModelsCursos::find($request->input('idCurso'));
                return view('admin.curso.show', compact(['curso','professores','situacoes']));
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
                $situacoes = SituacaesCursos::all();
                $professores = Professores::all();
                $curso = ModelsCursos::find($request->input('idCurso'));
                return view('admin.curso.editar', compact(['curso','professores','situacoes']));
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
                    $validated['imagem'] = Storage::disk('imagens')->put('assets/img/cursos', $request->file('imagem'));
                }

                $curso = ModelsCursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $curso->update($validated);
                    Session::flash('success','Atualizado com sucesso!');
                    return redirect()->route('editar.cursos', ['idCurso'=>$curso->id]);
                }

                return redirect()->back();
    
            }

            return abort(400);
        }

        return abort(403);
    }

}
