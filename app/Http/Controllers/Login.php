<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $usuario = User::where('cpf', $request->input('cpf'))->first();

        if($usuario != null)
        {
            if($usuario->senha === md5($request->input('senha')))
            {
                Auth::login($usuario);
                $request->session()->regenerate();
                return redirect()->route('home.servidor');
            }
        }
    
        return redirect()->route('form.login');
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
