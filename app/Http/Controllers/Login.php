<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Servidor;
use Illuminate\Support\Str;
use App\Models\Autenticacao;
use Illuminate\Http\Request;
use App\Models\DadosPessoais;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\CabecalhoContracheque;
use Illuminate\Support\Facades\Session;
use App\Notifications\ResetSenhaNotification;

class Login extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['login','index','resetarSenhaForm','resetarSenha']);
        $this->middleware('auth')->only(['logout','alterarSenhaForm','alterarSenha']);
    }

    public function index(Request $request)
    {
        $rotaAnterior = URL::previous();

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

    public function alterarSenhaForm()
    {
        return view('auth.alterar');
    }

    public function alterarSenha(Request $request)
    {
        $validated = $request->validate([
            'senha_atual'=>'required',
            'nova_senha'=>'required|confirmed|min:8',
        ]);

        $usuario = Servidor::find(Auth::user()->id);

        if($usuario->senha === md5($validated['senha_atual']))
        {
            $usuario->senha = md5($validated['nova_senha']);
            $usuario->update();

            Session::flash('success','Senha alterada com sucesso!');
            return redirect()->back();
        }

        Session::flash('error','Senha atual errada!');
        return redirect()->back();
    }

    public function resetarSenhaForm()
    {
        return view('auth.esqueci');
    }

    public function resetarSenha(Request $request)
    {
        $validated = $request->validate([
            'cpf'=>'required|cpf',
            'email'=>'required|email',
            'captcha' => 'required|captcha'
        ]);

        $usuario = Servidor::where('cpf',$validated['cpf'])
        ->where('email', $validated['email'])
        ->first();

        if($usuario != null)
        {
            $senha = str_replace(' ', 'Ef', Str::random(8));
            $usuario->senha = md5($senha);
            $usuario->update();

            $usuario->notify(new ResetSenhaNotification($usuario, $senha));
            Session::flash('success','Uma nova senha foi enviada para o email cadastrado!');
            return redirect()->route('login');
        }

        Session::flash('error','Os dados informados não são válidos.');
        return redirect()->back()->withInput($validated);
    }
}
