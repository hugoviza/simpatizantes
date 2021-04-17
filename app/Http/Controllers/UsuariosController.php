<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.usuarios', ['session' => $request->session()]);
    }

    public function listarUsuarios(Request $request) {
        if(isset($request->idUsuario)) {
            $usuarios = DB::select('SELECT * from tblusuario WHERE idUsuario = ?', [$request->idUsuario]);
        } else {
            $usuarios = DB::select('SELECT * from tblusuario');
        }

        return response()->json($usuarios, 200);
    }
}
