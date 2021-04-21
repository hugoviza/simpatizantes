<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class isLogin
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
        if(!$request->session() || !$request->session()->has('idUsuario')) {
            return Redirect::route('login');
        }

        // validamos que el usuario exista y este activo
        $users = DB::select('SELECT * FROM tblusuario WHERE idUsuario = ? AND activo = 1', [$request->session()->get('idUsuario')]);

        if(!sizeof($users)) {
            return Redirect::route('login');
        }

        return $next($request);
    }
}
