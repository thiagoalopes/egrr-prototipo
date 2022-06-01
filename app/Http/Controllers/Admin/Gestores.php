<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Gestores as ModelsGestores;

class Gestores extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $gestores = ModelsGestores::orderBy('id','DESC')->first();

            return view('admin.gestores.index',compact(['gestores']));
        }
        return abort(403);
    }

    public function cadastro()
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            return view('admin.gestores.cadastro');
        }
        return abort(403);
    }

    public function salvar(Request $request)
    {
        if(Gate::allows('isAdminCurso', Auth::user()))
        {
            $validated = $request->validate([
                'nome_secretario'=>'required',
                'nome_diretor_egrr'=>'required',
                'imagem_assinatura_secretario'=>'required|file|mimes:jpg,jpeg,png|max:1024|dimensions:max_width=300,max_height=200',
                'imagem_assinatura_diretor'=>'required|file|mimes:jpg,jpeg,png|max:1024|dimensions:max_width=300,max_height=200',
            ]);

            $validated['imagem_assinatura_secretario'] = Storage::disk('imagens')->put('assets/img/gestores', $request->file('imagem_assinatura_secretario'));
            $validated['imagem_assinatura_diretor'] = Storage::disk('imagens')->put('assets/img/gestores', $request->file('imagem_assinatura_diretor'));

            ModelsGestores::create($validated);

            Session::flash('success','Assinaturas cadastradas com sucesso!');
            return redirect()->back();
        }
        return abort(403);
    }

}
