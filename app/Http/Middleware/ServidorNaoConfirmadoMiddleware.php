<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServidorNaoConfirmadoMiddleware
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
        if($request->user() != null && $request->user()->servidor_confirmado)
        {
            Session::forget('warning');
            return $next($request);
        }
        elseif($request->user() == null)
        {
            Session::forget('warning');
            return $next($request);
        }

        Session::flash('warning','Seus dados serão validados pela Coordenação da EGRR. Por favor! Aguarde a confirmação para liberação do seu acesso!');

        if($request->routeIs('welcome') || 
            $request->routeIs('logout') ||
            $request->routeIs('form.login') ||
            $request->routeIs('login') ||
            $request->routeIs('show.servidor') ||
            $request->routeIs('update.servidor'))

        {
            return $next($request);
        }
        return response()->redirectToRoute('welcome');
    }
}
