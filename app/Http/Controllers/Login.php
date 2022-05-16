<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Servidor;
use App\Models\Autenticacao;
use Illuminate\Http\Request;
use App\Models\DadosPessoais;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\CabecalhoContracheque;

class Login extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //Busca na tabela autenticacao
        //Se não houver o usuaŕio devera se cadastrar
        $usuarioCC4 = Autenticacao::where('cpf', $request->input('cpf'))->first();
        $servidor = Servidor::where('cpf', $request->input('cpf'))->first();
        
        if($usuarioCC4 != null && $servidor == null)
        {
            if($usuarioCC4->senha === md5($request->input('senha')))
            {
                $cabecalhoContracheque = CabecalhoContracheque::where("cpf", $usuarioCC4->cpf)
                ->orderBy('ano','desc')
                ->orderBy('mes','desc')->first();

                $dadosPessoais = DadosPessoais::where('cpf', $usuarioCC4->cpf)->first();

                $servidor = [
                    'nome' => $cabecalhoContracheque->nome,
                    'cpf' => $cabecalhoContracheque->cpf,
                    'tipo_vinculo' => 'outro',
                    'matricula' => $cabecalhoContracheque->matricula,
                    'sexo' => 'o',
                    'cargo' => $cabecalhoContracheque->cargo,
                    'email' => $dadosPessoais->email,
                    'senha' => $usuarioCC4->senha,
                    'funcao' => $cabecalhoContracheque->funcao!=null?$cabecalhoContracheque->funcao:$cabecalhoContracheque->cargo,
                    'servidor_confirmado'=> true,
                    'celular' => $dadosPessoais->celular,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                
                $servidor = Servidor::create($servidor);

                Auth::login($servidor);

                if(Gate::allows('isAdminCurso') || Gate::allows('isAdminCartao'))
                {
                    return redirect()->route('home.administrador');
                }

                return redirect()->route('home.servidor');
            }
            return redirect()->back()->withErrors(['credenciais'=>'Usuário ou senha inválidos.']);
        }
        elseif($usuarioCC4 != null && $servidor != null)
        {
            if($usuarioCC4->senha === $servidor->senha)
            {
                if($servidor->senha === md5($request->input('senha')))
                {
                    Auth::login($servidor);

                    if(Gate::allows('isAdminCurso') || Gate::allows('isAdminCartao'))
                    {
                        return redirect()->route('home.administrador');
                    }
    
                    return redirect()->route('home.servidor');
                }

                return redirect()->back()->withErrors(['credenciais'=>'Usuário ou senha inválidos.']);
            }
            else{

                $servidor->senha = $usuarioCC4->senha;
                $servidor->update();

                if($servidor->senha === md5($request->input('senha')))
                {
                    Auth::login($servidor);

                    if(Gate::allows('isAdminCurso') || Gate::allows('isAdminCartao'))
                    {
                        return redirect()->route('home.administrador');
                    }
    
                    return redirect()->route('home.servidor');
                }

                return redirect()->back()->withErrors(['credenciais'=>'Usuário ou senha inválidos.']);
            }
        }
        elseif($usuarioCC4 == null && $servidor != null)
        {
            if($servidor->senha === md5($request->input('senha')))
            {
                Auth::login($servidor);

                if(Gate::allows('isAdminCurso') || Gate::allows('isAdminCartao'))
                {
                    return redirect()->route('home.administrador');
                }

                return redirect()->route('home.servidor');
            }

            return redirect()->back()->withErrors(['credenciais'=>'Usuário ou senha inválidos.']);
        }
        else
        {
            return redirect()->back()->withErrors(['credenciais'=>'Usuário não cadastrado.']);
        }
    
    }

    public function logout()
    {
        if(Auth::user() != null)
        {
            Auth::logout();
        }
        return redirect()->route('welcome');
    }
}
