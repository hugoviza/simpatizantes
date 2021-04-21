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
            $usuarios = DB::select('SELECT * from tblusuario order by nombre');
        }

        return response()->json($usuarios, 200);
    }

    public function guardarUsuario(Request $request) {

        //Validamos que nos estén enviando todos los datos
        if($request->nombre == "") {
            return response("Ingrese nombre de usuario", 400);
        }

        if($request->usuario == "") {
            return response("Ingrese usuario", 400);
        }

        if($request->nivelAcceso == "") {
            return response("Seleccione nivel acceso", 400);
        }

        if($request->password == "" && $request->idUsuario == "") {
            return response("Ingrese contraseña", 400);
        }

        //Primero validamos si el usuario ya existe
        if($request->idUsuario != "") {
            $usuariosDuplicados = DB::select('SELECT * from tblusuario WHERE usuario = ? AND idUsuario <> ?', [$request->usuario, $request->idUsuario]);
            $usuarios = DB::select('SELECT * from tblusuario WHERE idUsuario = ?', [$request->idUsuario]);
        } else {
            $usuariosDuplicados = DB::select('SELECT * from tblusuario WHERE usuario = ?', [$request->usuario]);
            $usuarios = array();
        }

        if(sizeof($usuariosDuplicados) > 0) {
            return response("El usuario ingresado no está disponible", 400);
        }

        //insertamos el nuevo usuario
        if(sizeof($usuarios) > 0) {
            //Edicion
            $password = $request->password ? md5($request->password) : $usuarios[0]->password;
            DB::update('UPDATE tblusuario set usuario = ?, nombre = ?, password = ? where idUsuario = ?', [
                $request->usuario,
                $request->nombre,
                $password,
                $request->idUsuario
            ]);

            return response("Usuario editado correctamente", 200);
        } else {
            //insert
            DB::insert(
                'INSERT INTO tblusuario 
                    (usuario, nombre, nivelAcceso, password, activo, fechaHoraAlta, intentosInicioSesion, limiteIntentosInicioSesion) values
                    (?, ?, ?, ?, 1, now(), 0, 1)', [
                        $request->usuario,
                        $request->nombre,
                        $request->nivelAcceso,
                        md5($request->password)]
            );
            
            return response("Usuario creado correctamente", 200);
        }

    }

    public function bloquearUsuario(Request $request) {
        //Validamos que nos estén enviando todos los datos
        if($request->idUsuario == "") {
            return response("Seleccione al usuario por bloquear", 400);
        }

        if($request->activo == "") {
            return response("Falta bit de bloqueo", 400);
        }

        //Validamos que exista el usuario por bloquear
        $usuarios = DB::select('SELECT * from tblusuario WHERE idUsuario = ?', [$request->idUsuario]);
        if(sizeof($usuarios) == 0) {
            return response("El usuario seleccionado no existe", 400);
        }

        DB::update('UPDATE tblusuario set activo = ? where idUsuario = ?', [
            $request->activo,
            $request->idUsuario
        ]);

        return response("Usuario ". ($request->activo == 1 ? "desbloqueado" : "bloqueado") ." correctamente", 200);
    }

    public function eliminarUsuario(Request $request) {
        //Validamos que nos estén enviando todos los datos
        if($request->idUsuario == "") {
            return response("Seleccione al usuario por bloquear", 400);
        }

        // no podemos eliminar al admin
        if(intval($request->idUsuario) == intval($request->session()->get('idUsuario'))) {
            return response("No es posible eliminar a tu propio usuario", 400);
        }

        //Validamos que exista el usuario por bloquear
        $usuarios = DB::select('SELECT * from tblusuario WHERE idUsuario = ?', [$request->idUsuario]);
        if(sizeof($usuarios) == 0) {
            return response("El usuario seleccionado no existe", 400);
        }

        //validamos que el usuario no haya registrado simpatizantes
        $simpatizantes = DB::select('SELECT count(*) AS totalSimpatizantes from tblsimpatizante WHERE idUsuario = ?', [$request->idUsuario]);

        if($simpatizantes[0]->totalSimpatizantes == 0) {
            DB::delete('DELETE FROM tblusuario WHERE idUsuario = ?', [$request->idUsuario]);
            return response("Usuario eliminado correctamente", 200);
        } else {
            return response("No es posible eliminar al usuario seleccionado, el usuario tiene {$simpatizantes[0]->totalSimpatizantes} simpatizantes registrados", 400);
        }

    }
}
