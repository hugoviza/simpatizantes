<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotoresController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.promotores', ['session' => $request->session()]);
    }

    public function listar(Request $request) {
        $strFiltros = '';
        $arrayValoresFiltros = array();
        if($request->idPromotor != '') {
            $strFiltros .= ' AND promotor.idSimpatizante = ?';
            array_push($arrayValoresFiltros, $request->idPromotor);
        }

        if($request->nombre != '') {
            $strFiltros .= " AND concat(ifnull(promotor.nombre,''), ' ', ifnull(promotor.apellidoPaterno,''), ' ', ifnull(promotor.apellidoMaterno,''), ' ', ifnull(promotor.curp,''), ' ', ifnull(promotor.claveElector,''), ' ', ifnull(promotor.numeroElector,'')) regexp ?";
            array_push($arrayValoresFiltros, str_replace(' ', '|', $request->nombre));
        }

        if($request->idSeccion != '') {
            $strFiltros .= ' AND promotor.idSeccion = ?';
            array_push($arrayValoresFiltros, $request->idSeccion);
        }

        if($request->idLocalidad != '') {
            $strFiltros .= ' AND promotor.idLocalidad = ?';
            array_push($arrayValoresFiltros, $request->idLocalidad);
        }

        if($request->fechaInicio != '') {
            $strFiltros .= ' AND promotor.fechaHoraAlta >= ?';
            array_push($arrayValoresFiltros, "$request->fechaInicio 00:00:00");
        }

        if($request->fechaFin != '') {
            $strFiltros .= ' AND promotor.fechaHoraAlta <= ?';
            array_push($arrayValoresFiltros, "$request->fechaFin 23:59:59");
        }

        if($request->fechaInicio != '') {
            $strFiltros .= ' AND promotor.fechaHoraAlta >= ?';
            array_push($arrayValoresFiltros, "$request->fechaInicio 00:00:00");
        }

        if($request->fechaFin != '') {
            $strFiltros .= ' AND promotor.fechaHoraAlta <= ?';
            array_push($arrayValoresFiltros, "$request->fechaFin 23:59:59");
        }

        if($request->session()->get('nivelAcceso') != 'admin') {
            $strFiltros .= ' AND promotor.idUsuario = ?';
            array_push($arrayValoresFiltros, $request->session()->get('idUsuario'));
        }
        

            $promotores = DB::select(
                "SELECT 
                    idSimpatizante AS idPromotor,
                    idLocalidad,
                    idSeccion,
                    idUsuario,
                    ifnull(nombre, '') nombre,
                    ifnull(apellidoMaterno, '') apellidoMaterno,
                    ifnull(apellidoPaterno, '') apellidoPaterno,
                    ifnull(domicilio, '') domicilio,
                    ifnull(numExt, '') numExt,
                    ifnull(numInt, '') numInt,
                    ifnull(colonia, '') colonia,
                    ifnull(codigoPostal, '') codigoPostal,
                    ifnull(claveElector, '') claveElector,
                    ifnull(numeroElector, '') numeroElector,
                    ifnull(curp, '') curp,
                    ifnull(telefono, '') telefono,
                    ifnull(date_format(fechaHoraAlta, '%d/%b/%Y %T'), '') fechaHoraAlta,
                    ifnull(sec.claveSeccion, '') claveSeccion,
                    ifnull(claveLocalidad, '') claveLocalidad,
                    ifnull(loc.localidad, '') localidad
                FROM
                    tblsimpatizante AS promotor
                        LEFT JOIN
                    tblseccion AS sec USING (idSeccion)
                        LEFT JOIN
                    tbllocalidad AS loc USING (idLocalidad)
                WHERE ifnull(promotor.bitPromotor,0) = 1
                {$strFiltros}", $arrayValoresFiltros);

        return response()->json($promotores, 200);
    }

    public function guardar(Request $request) {
        //Validamos que nos estén enviando todos los datos correctos
        if($request->nombre == "") {
            return response("Ingrese nombre del promotor", 400);
        }

        if($request->apellidoPaterno == "") {
            return response("Ingrese apellido paterno del promotor", 400);
        }

        if($request->apellidoMaterno == "") {
            return response("Ingrese apellido materno del promotor", 400);
        }

        if($request->domicilio == "") {
            return response("Ingrese direccion de domicilio del promotor", 400);
        }

        if($request->numExt == "") {
            return response("Ingrese número exterior de domicilio del promotor", 400);
        }

        if($request->colonia == "") {
            return response("Ingrese colonia del promotor", 400);
        }

        if($request->claveElector == "") {
            return response("Ingrese clave de elector del promotor", 400);
        }

        if($request->telefono == "") {
            return response("Ingrese número celular del promotor", 400);
        }

        if($request->idLocalidad == "") {
            return response("Ingrese una localidad válida para el promotor", 400);
        }

        if($request->telefono == "") {
            return response("Ingrese una sección válida para el promotor", 400);
        }

        if(!$request->session()->get('idUsuario')) {
            return response("Sesión de usuario caducada, por favor, inicie sesión nuevamente", 400);
        }

        if($request->idPromotor) {
            DB::update('UPDATE tblsimpatizante set 
                idLocalidad = ?, idSeccion = ?, 
                nombre = ?, apellidoMaterno = ?, apellidoPaterno = ?, 
                domicilio = ?, numExt = ?, numInt = ?, colonia = ?, codigoPostal = ?, 
                claveElector = ?, numeroElector = ?, curp = ?, seccion = ?, localidad = ?, 
                telefono = ?
                where idSimpatizante = ?', [
                $request->idLocalidad, $request->idSeccion,
                $request->nombre, $request->apellidoMaterno, $request->apellidoPaterno,
                $request->domicilio, $request->numExt, $request->numInt, $request->colonia, $request->codigoPostal,
                $request->claveElector, $request->numeroElector, $request->curp, $request->seccion, $request->localidad,
                $request->telefono,
                $request->idPromotor
            ]);

            return response("Promotor editado correctamente", 200);
        } else {
            DB::insert(
                "INSERT INTO tblsimpatizante
                    (`idUsuario`, `idLocalidad`, `idSeccion`, 
                    `nombre`, `apellidoMaterno`, `apellidoPaterno`, 
                    `domicilio`, `numExt`, `numInt`, `colonia`, `codigoPostal`, 
                    `claveElector`, `numeroElector`, `curp`, `seccion`, `localidad`,
                    `telefono`, `bitPromotor`, `fechaHoraAlta`) VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', now());
                ", [
                    $request->session()->get('idUsuario'), $request->idLocalidad, $request->idSeccion,
                    $request->nombre, $request->apellidoMaterno, $request->apellidoPaterno,
                    $request->domicilio, $request->numExt, $request->numInt, $request->colonia, $request->codigoPostal,
                    $request->claveElector, $request->numeroElector, $request->curp, $request->seccion, $request->localidad,
                    $request->telefono
                ]
            );

            return response("Promotor creado correctamente", 200);
        }
    }

    public function eliminar(Request $request) {
        //Validamos que nos estén enviando todos los datos correctos
        if($request->idPromotor == "") {
            return response("Seleccione a un promotor", 400);
        }

        $arrayPromotores = DB::select(
            "SELECT * FROM tblsimpatizante WHERE idSimpatizante = ? AND bitPromotor = 1; ", [$request->idPromotor]
        );

        if(sizeof($arrayPromotores) == 0) {
            return response("El promotor seleccionado no existe", 400);
        }

        //validamos que el promotor no esté vinculado con simpatizantes
        $simpatizantes = DB::select('SELECT count(*) AS totalSimpatizantes from tblsimpatizante WHERE idPromotor = ?', [$request->idPromotor]);

        if($simpatizantes[0]->totalSimpatizantes == 0) {
            DB::delete('DELETE FROM tblsimpatizante WHERE idSimpatizante = ?', [$request->idPromotor]);
            return response("Promotor eliminado correctamente", 200);
        } else {
            return response("No es posible eliminar al promotor seleccionado, el promotor tiene {$simpatizantes[0]->totalSimpatizantes} simpatizantes vinculados", 400);
        }
    }

    public function autocomplete(Request $request) {
        $busqueda = str_replace(' ', '|', $request->txtBusqueda);

        $arrayPromotores = DB::select(
            "SELECT 
                CONCAT(nombre, ' ', apellidoMaterno, ' ', apellidoPaterno) as value,
                idSimpatizante as idPromotor
            FROM tblsimpatizante 
            WHERE CONCAT(nombre, ' ', apellidoMaterno, ' ', apellidoPaterno) REGEXP '$busqueda' 
            AND bitPromotor = 1 order by CONCAT(nombre, ' ', apellidoMaterno, ' ', apellidoPaterno); "
        );

        return response()->json($arrayPromotores, 200);
    }
}
