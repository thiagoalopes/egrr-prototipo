<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cursos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use App\Models\ConteudosCursos as ModelsConteudosCursos;

class ConteudosCursos extends Controller
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
                    if($request->has('conteudo'))
                    {
                        $conteudos = ModelsConteudosCursos::where('id_curso', $request->input('idCurso'))
                        ->whereRaw("LOWER(nome) like '%".strtolower($request->input('conteudo'))."%'")
                        ->orderBy('sequencial_ordenacao', 'ASC')
                        ->paginate(15);
                        return view('admin.conteudos.index', compact(['conteudos', 'curso']));
                    }

                    $conteudos = ModelsConteudosCursos::where('id_curso', $request->input('idCurso'))
                    ->orderBy('sequencial_ordenacao', 'ASC')
                    ->paginate(15);
                    return view('admin.conteudos.index', compact(['conteudos', 'curso']));
                }
                return abort(404);
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
                    return view('admin.conteudos.cadastro', compact(['curso']));
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
                    'sequencial_ordenacao'=>'required',
                    'conteudo'=>'required|max:128',
                ]);

                $curso = Cursos::find($request->input('id_curso'));

                if($curso != null)
                {
                    ModelsConteudosCursos::create($validated);
                    Session::flash('success','Cadastrado com sucesso!');
                    return redirect()->route('cadastro.conteudos',['idCurso'=>$curso->id]); 
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
            if($request->has('idCurso') && $request->has('idConteudo'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $conteudo = ModelsConteudosCursos::where('id_curso', $request->input('idCurso'))
                    ->where('id', $request->has('idConteudo'))
                    ->orderBy('sequencial_ordenacao', 'ASC')
                    ->first();

                    if($conteudo != null)
                    {
                        return view('admin.conteudos.show', compact(['conteudo','curso']));
                    }

                }
                return abort(404);
            }

            return abort(404);
        }
        return abort(403);
    }

    public function editar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso') && $request->has('idConteudo'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $conteudo = ModelsConteudosCursos::where('id_curso', $request->input('idCurso'))
                    ->where('id', $request->input('idConteudo'))->first();

                    if($conteudo != null)
                    {
                        return view('admin.conteudos.editar', compact(['conteudo','curso']));
                    }

                    return redirect()->route('listar.conteudos', ['idCurso'=>$curso->id]);
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
            if($request->has('idCurso') && $request->has('idConteudo'))
            {
                $validated = $request->validate([
                    'sequencial_ordenacao'=>'required',
                    'conteudo'=>'required|max:128',
                ]);

                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $conteudo = ModelsConteudosCursos::find($request->input('idConteudo'));

                    if($conteudo != null)
                    {
                        $conteudo->update($validated);
                        Session::flash('success','Atualizado com sucesso!');
                        return redirect()->route('editar.conteudos', ['idCurso'=>$curso->id, 'idConteudo'=>$conteudo->id]);
                    }

                    return redirect()->back();
                }

                return redirect()->back();
    
            }

            return abort(404);
        }

        return abort(403);
    }

    public function remover(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idCurso') && $request->has('idConteudo'))
            {
                $curso = Cursos::find($request->input('idCurso'));

                if($curso != null)
                {
                    $conteudo = ModelsConteudosCursos::find($request->input('idConteudo'));

                    if($conteudo != null)
                    {
                        $conteudo->delete();
                        Session::flash('success','removido com sucesso!');
                        return redirect()->route('listar.conteudos', ['idCurso'=>$curso->id]);
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
