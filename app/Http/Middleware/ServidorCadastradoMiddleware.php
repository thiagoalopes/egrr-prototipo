<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServidorCadastradoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $servidor = Servidor::where('cpf', $request->user()->cpf)->first();

        if($servidor != null)
        {

            if($servidor->cpf == null ||
                 $servidor->nome == null ||
                 $servidor->matricula == null ||
                 $servidor->tipo_vinculo == null ||
                 $servidor->sexo == null ||
                 $servidor->cargo == null ||
                 $servidor->id_secretaria_servidores == null ||
                 $servidor->email == null ||
                 $servidor->celular == null)
            {
                Session::flash('success','Por favor, atualize todos os seus dados!');
                return redirect()->route('show.servidor');
            }

            return $next($request);
        }

        return redirect()->route('show.servidor');
    }
}
