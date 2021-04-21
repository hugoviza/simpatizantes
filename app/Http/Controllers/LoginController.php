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
        $users = DB::select('SELECT * FROM tblusuario WHERE usuario = ?', [$request->txtUsuario]);
        
        if(sizeof($users) == 0) {
            return response("usuario no encontrado", 404);
        }
        
        if($users[0]->activo != 1) {
            return response("usuario inactivo", 401);
        }

        if($users[0]->password != md5($request->txtPassword)) {
            return response("Contraseña incorrecta", 401);
        }

        $session = new SessionController();
        $session->setSession($request, $users[0]);
        
        return response("Sesión iniciada correctamente", 200);
    }
}
