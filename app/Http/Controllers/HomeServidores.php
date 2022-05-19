<?php

namespace App\Http\Controllers;

use App\Models\Autenticacao;
use App\Models\CabecalhoContracheque;
use Illuminate\Http\Request;
use App\Models\DadosPessoais;
use App\Models\SecretariaServidores;
use App\Models\Servidor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeServidores extends Controller
{

    public function __construct()
    {
        //Tudo é protegido pela guard auth
        //só visualiza as rotas se o usuário estiver logado
        $this->middleware('auth')->except(['salvar','cadastro','reloadCaptcha']);
    }

    public function index()
    {
        return view('servidor.index');
    }

    public function show()
    {
        $secretarias = SecretariaServidores::all();

        //Busca o servidor na tb_servidor para verificar se o registro existe
        $servidor = Auth::user();
        
        if($servidor != null)
        {
            return view('servidor.atualizacao', compact(['servidor','secretarias']));
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        //Valida os dados do servidor
        $validated = $request->validate([
            'tipo_vinculo'=>'required|in:efetivo,efetcomis,comissionado,temporario,outro',
            'matricula'=>'required|regex:/^[0-9]+$/',
            'sexo'=>'required|in:f,m,o,n',
            'cargo'=>'required|min:5',
            'funcao'=>'required|min:5',
            'secretaria'=>'required|regex:/^[0-9]+$/',
            'email'=>'required|email',
            'celular'=>'required|celular_com_ddd',
            'telefone'=>'nullable|telefone_com_ddd',
        ]);

        //Mapeia os campos validados para o nome das colunas do banco
        //de dados
        $mappedData = [
            'tipo_vinculo'=>$validated['tipo_vinculo'],
            'matricula'=>$validated['matricula'],
            'sexo'=>$validated['sexo'],
            'cargo'=>$validated['cargo'],
            'funcao'=>$validated['funcao'],
            'id_secretaria_servidores'=>$validated['secretaria'],
            'email'=>$validated['email'],
            'celular'=>$validated['celular'],
            'telefone'=>$validated['telefone'],
        ];

        //busca o cadastro do servidor pelo cpf do usuário logado
        //e atualiza.
        $servidor = Servidor::where('cpf', $user->cpf)->first();
        $servidor->update($mappedData);
        Session::flash('success','Dados atualizados!');
        return redirect()->route('show.servidor');
    }

    public function cadastro()
    {
        $usuario = Auth::user();

        if($usuario != null)
        {
            return redirect()->route('home.servidor');
        }

        $secretarias = SecretariaServidores::all();
        return view('servidor.cadastro',compact(['secretarias']));
    }

    public function salvar(Request $request)
    {
        $validated = $request->validate([
            'nome'=>'required|max:128',
            'cpf'=>'required|cpf',
            'tipo_vinculo'=>'required|in:efetivo,efetcomis,comissionado,temporario,outro',
            'matricula'=>'required|regex:/^[0-9]+$/|unique:tb_servidores',
            'sexo'=>'required|in:f,m,o,n',
            'cargo'=>'required|min:5',
            'funcao'=>'required|min:5',
            'secretaria'=>'required|regex:/^[0-9]+$/',
            'email'=>'required|email',
            'senha'=>'required|confirmed',
            'celular'=>'required|celular_com_ddd',
            'telefone'=>'nullable|telefone_com_ddd',
            'captcha' => 'required|captcha'
        ]);

        $servidor = Servidor::where('cpf', $validated['cpf'])->first();
        
        if($servidor != null)
        {
            Session::flash('error','O CPF informado já foi cadastrado!');
            return redirect()->route('cadastro.servidor')->withInput($validated);
        }

        //Mapeia os campos validados para o nome das colunas do banco
        //de dados
        $mappedData = [
            'nome'=>$validated['nome'],
            'cpf'=>$validated['cpf'],
            'tipo_vinculo'=>$validated['tipo_vinculo'],
            'matricula'=>$validated['matricula'],
            'sexo'=>$validated['sexo'],
            'cargo'=>$validated['cargo'],
            'funcao'=>$validated['funcao'],
            'id_secretaria_servidores'=>$validated['secretaria'],
            'email'=>$validated['email'],
            'servidor_confirmado'=>'false',
            'senha'=>md5($validated['senha']),
            'celular'=>$validated['celular'],
            'telefone'=>$validated['telefone'],
        ];

        Servidor::create($mappedData);
        Session::flash('success','Cadastro realizado com sucesso!');
        return redirect()->route('login');
    }
}

