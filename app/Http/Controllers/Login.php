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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class Login extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request)
    {
        $rotaAnterior = URL::previous();

        //dd($rotaAnterior);
        //dd(route('welcome'));

        if(route('welcome').'/' == $rotaAnterior)
        {
            return view('auth.login');
        }

        return view('auth.login',compact(['rotaAnterior']));
    }

    public function login(Request $request)
    {
        if($request->has('senha_portal') && $request->input('senha_portal') == 1)
        {
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

                    $servidor = [];

                    if($dadosPessoais != null && $cabecalhoContracheque != null) 
                    {
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
                    }
                    elseif($dadosPessoais == null && $cabecalhoContracheque != null)
                    {

                        $servidor = [
                            'nome' => $cabecalhoContracheque->nome,
                            'cpf' => $cabecalhoContracheque->cpf,
                            'tipo_vinculo' => 'outro',
                            'matricula' => $cabecalhoContracheque->matricula,
                            'sexo' => 'o',
                            'cargo' => $cabecalhoContracheque->cargo,
                            'email' => '',
                            'senha' => $usuarioCC4->senha,
                            'funcao' => $cabecalhoContracheque->funcao!=null?$cabecalhoContracheque->funcao:$cabecalhoContracheque->cargo,
                            'servidor_confirmado'=> true,
                            'celular' => '',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    else
                    {
                        $servidor = [
                            'nome' => '',
                            'cpf' => $usuarioCC4->cpf,
                            'tipo_vinculo' => 'outro',
                            'matricula' => '',
                            'sexo' => 'o',
                            'cargo' => '',
                            'email' => '',
                            'senha' => $usuarioCC4->senha,
                            'funcao' => '',
                            'servidor_confirmado'=> true,
                            'celular' => '',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                    
                    $servidor = Servidor::create($servidor);

                    Auth::login($servidor);

                    if(Gate::allows('isAdminCurso', $servidor) || Gate::allows('isAdminCartao', $servidor))
                    {
                       return $request->rotaAnterior?
                       redirect($request->rotaAnterior):
                        redirect()->route('home.administrador');
                    }

                    return $request->rotaAnterior?
                    redirect($request->rotaAnterior):
                     redirect()->route('home.servidor');
                }

                Session::flash('error','Usuário ou senha inválidos');
                return redirect()->back();
            }
            elseif($usuarioCC4 != null && $servidor != null)
            {
                if($usuarioCC4->senha === md5($request->input('senha')))
                {
                    Auth::login($servidor);

                    if(Gate::allows('isAdminCurso') || Gate::allows('isAdminCartao'))
                    {
                        return $request->rotaAnterior?
                        redirect($request->rotaAnterior):
                         redirect()->route('home.administrador');
                    }
    
                    return $request->rotaAnterior?
                    redirect($request->rotaAnterior):
                     redirect()->route('home.servidor');
                }

                Session::flash('error','Usuário ou senha inválidos.');
                return redirect()->back();
            }
            elseif($usuarioCC4 == null)
            {
                Session::flash('error','Usuário não cadastrado no Portal do Servidor.');
                return redirect()->back();
            }
        }
        elseif(!$request->has('senha_portal') || $request->input('senha_portal') != 1)
        {
            $servidor = Servidor::where('cpf', $request->input('cpf'))->first();

            if($servidor != null)
            {
                if($servidor->senha === md5($request->input('senha')))
                {
                    Auth::login($servidor);
    
                    if(Gate::allows('isAdminCurso') || Gate::allows('isAdminCartao'))
                    {
                        return $request->rotaAnterior?
                        redirect($request->rotaAnterior):
                         redirect()->route('home.administrador');
                    }
    
                    return $request->rotaAnterior?
                    redirect($request->rotaAnterior):
                     redirect()->route('home.servidor');
                }
    
                Session::flash('error','Usuário ou senha inválidos.');
                return redirect()->back();
            }

            Session::flash('error','Usuário não cadastrado.');
            return redirect()->back();
        }
        return redirect()->back();
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
