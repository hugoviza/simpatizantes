<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSession(Request $request) {
        if($request->session()->has('idUsuario')) {
            return $request->session();
        } else {
            return false;
        }
    }

    public function setSession(Request $request, $usuario) {
        $request->session()->put('idUsuario', $usuario->idUsuario);
        $request->session()->put('usuario', $usuario->usuario);
        $request->session()->put('nombre', $usuario->nombre);
        $request->session()->put('nivelAcceso', $usuario->nivelAcceso);
        $request->session()->put('fechaHoraAlta', $usuario->fechaHoraAlta);
        $request->session()->put('nombre', $usuario->nombre);
    }

    public function deleteSession(Request $request) {
        $request->session()->forget('idUsuario');
        $request->session()->forget('usuario');
        $request->session()->forget('nombre');
        $request->session()->forget('nivelAcceso');
        $request->session()->forget('fechaHoraAlta');
        $request->session()->forget('nombre');
    }
}
