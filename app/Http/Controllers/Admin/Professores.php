<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use App\Models\Professores as ModelsProfessores;

class Professores extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $professores = null;

            if($request->has('nome'))
            {
                $professores = ModelsProfessores::whereRaw("LOWER(nome) like '%".strtolower($request->input('nome'))."%'")->paginate(15);
                return view('admin.professor.index', compact(['professores']));
            }

            $professores = ModelsProfessores::paginate(15);
            return view('admin.professor.index', compact(['professores']));
        }

        return abort(403);
    }

    public function cadastro()
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            return view('admin.professor.cadastro');
        }
        return abort(403);
    }

    public function detalhes(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idProfessor'))
            {
                $professor = Modelsprofessores::find($request->input('idProfessor'));
                return view('admin.professor.show', compact(['professor']));
            }

            return redirect()->back();
        }
        return abort(403);
    }

    public function salvar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $validated = $request->validate([
                'nome'=>'required|min:5|max:128',
                'cpf'=>'nullable|cpf',
                'sexo'=>'required|in:f,m,o',
                'email'=>'nullable|email',
                'celular'=>'nullable|celular_com_ddd',
            ]);

            Modelsprofessores::create($validated);
            Session::flash('success','Cadastrado com sucesso!');
            return view('admin.professor.cadastro');
        }

        return abort(403);
    }

    public function editar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {

            if($request->has('idProfessor'))
            {
                $professor = Modelsprofessores::find($request->input('idProfessor'));
                return view('admin.professor.editar', compact(['professor']));
            }

            return redirect()->back();
        }

        return abort(403);
    }

    public function atualizar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            if($request->has('idProfessor'))
            {
                $validated = $request->validate([
                    'nome'=>'required|min:5|max:128',
                    'cpf'=>'nullable|cpf',
                    'sexo'=>'required|in:f,m,o',
                    'email'=>'nullable|email',
                    'celular'=>'nullable|celular_com_ddd',
                ]);

                $professor = ModelsProfessores::find($request->input('idProfessor'));

                if($professor != null)
                {
                    $professor->update($validated);
                }
    
                Session::flash('success','Atualizado com sucesso!');
                return redirect()->route('editar.professores', ['idProfessor'=>$professor->id]);
            }

            return abort(400);

        }

        return abort(403);
    }


}
