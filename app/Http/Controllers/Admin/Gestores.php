<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $gestores = ModelsGestores::orderBy('id','DESC')->first();

        return view('admin.gestores.index',compact(['gestores']));

    }

    public function cadastro()
    {
        return view('admin.gestores.cadastro');
    }

    public function salvar(Request $request)
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

}
