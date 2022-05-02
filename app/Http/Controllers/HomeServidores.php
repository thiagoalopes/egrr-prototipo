<?php

namespace App\Http\Controllers;

use App\Models\CabecalhoContracheque;
use Illuminate\Http\Request;
use App\Models\DadosPessoais;
use App\Models\SecretariaServidores;
use App\Models\Servidor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeServidores extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('servidor.index');
    }

    public function cadastro()
    {

        $secretarias = SecretariaServidores::all(); 
        //Busca o servidor na tb_servidor para verificar se o registro existe
        $servidor = Servidor::where('cpf', Auth::user()->cpf)->first();
        
        if($servidor != null)
        {
            return view('servidor.cadastro', compact(['servidor','secretarias']));
        }
        
        #caso não exista o registro na tabela tb_servidores
        #os dados são buscados primeiramente na tb_dadospessoais, cabecalho
        #e rotarnados para a view. 
        $dadosPessoais = Auth::user()->dados;
        $cabecalhoContracheque = CabecalhoContracheque::where("cpf", Auth::user()->cpf)
        ->orderBy('ano','desc')
        ->orderBy('mes','desc')->first();
        
        $servidor = [
            'nome' => $cabecalhoContracheque->nome,
            'cpf' => $cabecalhoContracheque->cpf,
            'tipo_vinculo' => 'outro',
            'matricula' => $cabecalhoContracheque->matricula,
            'sexo' => 'o',
            'cargo' => $cabecalhoContracheque->funcao,
            'email' => $dadosPessoais->email,
            'celular' => $dadosPessoais->celular,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $servidor = Servidor::create($servidor);
        return view('servidor.cadastro', compact(['servidor','secretarias']));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nome'=>'required|min:5',
            'cpf'=>'required',
            'vinculo'=>'required|in:efetivo,comissionado,temporario,outro',
            'matricula'=>'required',
            'sexo'=>'required|in:f,m,o',
            'cargo'=>'required|min:5',
            'secretaria'=>'required',
            'email'=>'required|email',
            'celular'=>'required|min:11',
            'telefone'=>'nullable|min:10',
        ]);

        $user = Auth::user();
        $user-
        
        dd($request->all());
    }

}

