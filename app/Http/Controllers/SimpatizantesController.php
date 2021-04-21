<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SimpatizantesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.simpatizantes', ['session' => $request->session()]);
    }

    public function listar(Request $request) {

        if(isset($request->idSimpatizante)) {
            $promotores = DB::select(
                "SELECT 
                    simp.idSimpatizante,
                    simp.idPromotor,
                    simp.idLocalidad,
                    simp.idSeccion,
                    simp.idUsuario,
                    ifnull(simp.nombre, '') nombre,
                    ifnull(simp.apellidoMaterno, '') apellidoMaterno,
                    ifnull(simp.apellidoPaterno, '') apellidoPaterno,
                    ifnull(simp.domicilio, '') domicilio,
                    ifnull(simp.numExt, '') numExt,
                    ifnull(simp.numInt, '') numInt,
                    ifnull(simp.colonia, '') colonia,
                    ifnull(simp.codigoPostal, '') codigoPostal,
                    ifnull(simp.claveElector, '') claveElector,
                    ifnull(simp.numeroElector, '') numeroElector,
                    ifnull(simp.curp, '') curp,
                    ifnull(simp.telefono, '') telefono,
                    ifnull(simp.fechaHoraAlta, '') fechaHoraAlta,
                    ifnull(sec.claveSeccion, '') claveSeccion,
                    ifnull(claveLocalidad, '') claveLocalidad,
                    ifnull(loc.localidad, '') localidad,
                    CONCAT(prom.nombre, ' ', prom.apellidoMaterno, ' ', prom.apellidoPaterno) promotor
                FROM
                    tblsimpatizante AS simp
                        LEFT JOIN
                    tblseccion AS sec USING (idSeccion)
                        LEFT JOIN
                    tbllocalidad AS loc USING (idLocalidad)
                        LEFT JOIN
                    tblsimpatizante as prom on prom.idSimpatizante = simp.idPromotor
                WHERE simp.idSimpatizante = ?
                AND ifnull(simp.bitPromotor,0) <> 1", [$request->idSimpatizante]);
        } else {
            // $limit = 
            $promotores = DB::select(
                "SELECT 
                    simp.idSimpatizante,
                    simp.idPromotor,
                    simp.idLocalidad,
                    simp.idSeccion,
                    simp.idUsuario,
                    ifnull(simp.nombre, '') nombre,
                    ifnull(simp.apellidoMaterno, '') apellidoMaterno,
                    ifnull(simp.apellidoPaterno, '') apellidoPaterno,
                    ifnull(simp.domicilio, '') domicilio,
                    ifnull(simp.numExt, '') numExt,
                    ifnull(simp.numInt, '') numInt,
                    ifnull(simp.colonia, '') colonia,
                    ifnull(simp.codigoPostal, '') codigoPostal,
                    ifnull(simp.claveElector, '') claveElector,
                    ifnull(simp.numeroElector, '') numeroElector,
                    ifnull(simp.curp, '') curp,
                    ifnull(simp.telefono, '') telefono,
                    ifnull(simp.fechaHoraAlta, '') fechaHoraAlta,
                    ifnull(sec.claveSeccion, '') claveSeccion,
                    ifnull(claveLocalidad, '') claveLocalidad,
                    ifnull(loc.localidad, '') localidad,
                    CONCAT(prom.nombre, ' ', prom.apellidoMaterno, ' ', prom.apellidoPaterno) promotor
                FROM
                    tblsimpatizante as simp
                        LEFT JOIN
                    tblseccion AS sec USING (idSeccion)
                        LEFT JOIN
                    tbllocalidad AS loc USING (idLocalidad)
                        LEFT JOIN
                    tblsimpatizante as prom on prom.idSimpatizante = simp.idPromotor
                WHERE ifnull(simp.bitPromotor,0) <> 1");
        }

        return response()->json($promotores, 200);
    }

    public function guardar(Request $request) {
        //Validamos que nos estén enviando todos los datos correctos
        if($request->nombre == "") {
            return response("Ingrese nombre del simpatizante", 400);
        }

        if($request->apellidoPaterno == "") {
            return response("Ingrese apellido paterno del simpatizante", 400);
        }

        if($request->apellidoMaterno == "") {
            return response("Ingrese apellido materno del simpatizante", 400);
        }

        if($request->domicilio == "") {
            return response("Ingrese direccion de domicilio del simpatizante", 400);
        }

        if($request->numExt == "") {
            return response("Ingrese número exterior de domicilio del simpatizante", 400);
        }

        if($request->colonia == "") {
            return response("Ingrese colonia del simpatizante", 400);
        }

        if($request->claveElector == "") {
            return response("Ingrese clave de elector del simpatizante", 400);
        }

        if($request->telefono == "") {
            return response("Ingrese número celular del simpatizante", 400);
        }

        if($request->idLocalidad == "") {
            return response("Ingrese una localidad válida para el simpatizante", 400);
        }

        if($request->telefono == "") {
            return response("Ingrese una sección válida para el simpatizante", 400);
        }

        if(!$request->session()->get('idUsuario')) {
            return response("Sesión de usuario caducada, por favor, inicie sesión nuevamente", 400);
        }

        if($request->idSimpatizante) {
            DB::update('UPDATE tblsimpatizante set 
                idLocalidad = ?, idSeccion = ?, 
                nombre = ?, apellidoMaterno = ?, apellidoPaterno = ?, 
                domicilio = ?, numExt = ?, numInt = ?, colonia = ?, codigoPostal = ?, 
                claveElector = ?, numeroElector = ?, curp = ?, seccion = ?, localidad = ?, 
                telefono = ?, idPromotor = ?
                where idSimpatizante = ?', [
                $request->idLocalidad, $request->idSeccion,
                $request->nombre, $request->apellidoMaterno, $request->apellidoPaterno,
                $request->domicilio, $request->numExt, $request->numInt, $request->colonia, $request->codigoPostal,
                $request->claveElector, $request->numeroElector, $request->curp, $request->seccion, $request->localidad,
                $request->telefono, $request->idPromotor,
                $request->idSimpatizante
            ]);

            return response("Simpatizante editado correctamente", 200);
        } else {
            DB::insert(
                "INSERT INTO tblsimpatizante
                    (`idUsuario`, `idLocalidad`, `idSeccion`, 
                    `nombre`, `apellidoMaterno`, `apellidoPaterno`, 
                    `domicilio`, `numExt`, `numInt`, `colonia`, `codigoPostal`, 
                    `claveElector`, `numeroElector`, `curp`, `seccion`, `localidad`,
                    `telefono`, `idPromotor`, `bitPromotor`, `fechaHoraAlta`) VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', now());
                ", [
                    $request->session()->get('idUsuario'), $request->idLocalidad, $request->idSeccion,
                    $request->nombre, $request->apellidoMaterno, $request->apellidoPaterno,
                    $request->domicilio, $request->numExt, $request->numInt, $request->colonia, $request->codigoPostal,
                    $request->claveElector, $request->numeroElector, $request->curp, $request->seccion, $request->localidad,
                    $request->telefono, $request->idPromotor
                ]
            );

            return response("Simpatizante creado correctamente", 200);
        }
    }

    public function eliminar(Request $request) {
        //Validamos que nos estén enviando todos los datos correctos
        if($request->idSimpatizante == "") {
            return response("Seleccione a un simpatizante", 400);
        }
        
        $arraySimpatizantes = DB::select(
            "SELECT * FROM tblsimpatizante WHERE idSimpatizante = ?; ", [$request->idSimpatizante]
        );

        if(sizeof($arraySimpatizantes) == 0) {
            return response("El simpatizante seleccionado no existe", 400);
        }

        DB::delete('DELETE FROM tblsimpatizante WHERE idSimpatizante = ?', [$request->idSimpatizante]);
        return response("Simpatizante eliminado correctamente", 200);
    }

    public function autocomplete(Request $request) {
        $busqueda = str_replace(' ', '|', $request->txtBusqueda);

        $arraySimpatizantes = DB::select(
            "SELECT 
                CONCAT(nombre, ' ', apellidoMaterno, ' ', apellidoPaterno) as label,
                idSimpatizante as value
            FROM tblsimpatizante 
            WHERE CONCAT(nombre, ' ', apellidoMaterno, ' ', apellidoPaterno) REGEXP '$busqueda' 
            AND ifnull(bitPromotor, 0) <> 1 order by CONCAT(nombre, ' ', apellidoMaterno, ' ', apellidoPaterno); "
        );

        return response()->json($arraySimpatizantes, 200);
    }

    public function subirDocumento(Request $request) {
        $filename = "documento_".time();

        return response()->json($request, 200);
        //Storage::disk('local')->put('example.txt', 'Contents');
    }
}
