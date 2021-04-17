<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(Request $request) {
        $session = new SessionController();
        $session->deleteSession($request);
        return view('login.login');
    }

    //api
    public function login(Request $request)
    {
        $users = DB::select('select * from tblusuario where usuario = ?', [$request->txtUsuario]);
        
        if(sizeof($users) == 0) {
            return response()->json("usuario no encontrado", 404);
        }
        
        if($users[0]->activo != 1) {
            return response()->json("usuario inactivo", 401);
        }

        if($users[0]->password != md5($request->txtPassword)) {
            return response()->json("Contraseña incorrecta", 401);
        }

        $session = new SessionController();
        $session->setSession($request, $users[0]);
        
        return response()->json("Sesión iniciada correctamente", 200);
    }
}
