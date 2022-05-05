<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();

        //Valida os dados do servidor
        $validated = $request->validate([
            'tipo_vinculo'=>'required|in:efetivo,comissionado,temporario,outro',
            'matricula'=>'required|regex:/^[0-9]+$/',
            'sexo'=>'required|in:f,m,o',
            'cargo'=>'required|min:5',
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
        return redirect()->route('cadastro.servidor');
    }

}

