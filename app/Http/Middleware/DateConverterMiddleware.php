<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DateConverterMiddleware
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
        if(isset($request->data_inicio))
        {
            $request->merge(['data_inicio'=>str_replace('/','-',$request->input('data_inicio'))]);
        }
        if(isset($request->data_termino))
        {
            $request->merge(['data_termino'=>str_replace('/','-',$request->input('data_termino'))]);
        }
        if(isset($request->data_aula))
        {
            $request->merge(['data_aula'=>str_replace('/','-',$request->input('data_aula'))]);
        }
        return $next($request);
    }
}
