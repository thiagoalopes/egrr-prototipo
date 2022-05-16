<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SecretariaServidores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CadastroServidor extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function cadastro()
    {
        if(Gate::allows('isAdminCurso', Auth::user()) || 
            Gate::allows('isAdminCartao', Auth::user()))
        {
            $secretarias = SecretariaServidores::all();
            return view('admin.servidores.cadastro',compact(['secretarias']));
        }
        return abort(403);
    }

    public function salvar()
    {
        return abort(403);
    }
}
