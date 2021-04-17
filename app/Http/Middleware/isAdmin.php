<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session() || !$request->session()->has('idUsuario') || $request->session()->get('nivelAcceso') != 'admin') {
            return Redirect::route('home');
        }
        return $next($request);
    }
}
