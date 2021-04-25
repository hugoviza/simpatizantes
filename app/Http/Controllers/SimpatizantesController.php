<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

use App\Exports\SimpatizantesExport;
use Maatwebsite\Excel\Facades\Excel;

class SimpatizantesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.simpatizantes', ['session' => $request->session()]);
    }

    public function listar(Request $request) {

        $data = $this->consultaSimpatizantes($request);
        
        return response()->json($data, 200);
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
            // validamos que no este registrada la curp, clave ine, numero ine
            $curpDuplicada = array();
            $claveElectorDuplicada = array();
            $numeroElectorDuplicada = array();

            if($request->curp != '') {
                $curpDuplicada = DB::select("SELECT * FROM tblsimpatizante WHERE curp = ? AND idSimpatizante <> ? ", [$request->curp, $request->idSimpatizante]);
            }

            if($request->claveElector != '') {
                $claveElectorDuplicada = DB::select("SELECT * FROM tblsimpatizante WHERE claveElector = ? AND idSimpatizante <> ? ", [$request->claveElector, $request->idSimpatizante]);
            }

            if($request->numeroElector != '') {
                $numeroElectorDuplicada = DB::select("SELECT * FROM tblsimpatizante WHERE numeroElector = ? AND idSimpatizante <> ? ", [$request->numeroElector, $request->idSimpatizante]);
            }

            if(sizeof($curpDuplicada) > 0) {
                return response("La clave curp ya está siendo utilizada para otro simpatizante", 400);
            }

            if(sizeof($claveElectorDuplicada) > 0) {
                return response("La clave elector ya está siendo utilizada para otro simpatizante", 400);
            }

            if(sizeof($numeroElectorDuplicada) > 0) {
                return response("El número de elector está siendo utilizado por otro simpatizante", 400);
            }

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

            // validamos que no este registrada la curp, clave ine, numero ine
            $curpDuplicada = array();
            $claveElectorDuplicada = array();
            $numeroElectorDuplicada = array();

            if($request->curp != '') {
                $curpDuplicada = DB::select("SELECT * FROM tblsimpatizante WHERE curp = ? ", [$request->curp]);
            }

            if($request->claveElector != '') {
                $claveElectorDuplicada = DB::select("SELECT * FROM tblsimpatizante WHERE claveElector = ? ", [$request->claveElector]);
            }

            if($request->numeroElector != '') {
                $numeroElectorDuplicada = DB::select("SELECT * FROM tblsimpatizante WHERE numeroElector = ? ", [$request->numeroElector]);
            }

            if(sizeof($curpDuplicada) > 0) {
                return response("La clave curp ya está siendo utilizada para otro simpatizante", 400);
            }

            if(sizeof($claveElectorDuplicada) > 0) {
                return response("La clave elector ya está siendo utilizada para otro simpatizante", 400);
            }

            if(sizeof($numeroElectorDuplicada) > 0) {
                return response("El número de elector está siendo utilizado por otro simpatizante", 400);
            }
            

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

            $idSimpatizante = DB::getPdo()->lastInsertId();
            $index = 0;

            foreach ($request->arrayDocumentos as $doc) {
                $index++;
                if($doc != '') {
                    DB::insert(
                        "INSERT INTO tblsimpatizantedocumento
                            (`idSimpatizante`, `nombre`, `url`, `fechaSubida`) VALUES 
                            (?, ?, ?, now());", [$idSimpatizante, "Documento $index", $doc]
                    );
                }
            }

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
        if($request->file()) {
            $pathFile1 = '';
            $pathFile2 = '';

            if($request->file('file1'))
                $pathFile1 = $request->file('file1')->store('simpatizantes', 'public');

            if($request->file('file2'))
                $pathFile2 = $request->file('file2')->store('simpatizantes', 'public');

            return response()->json(array($pathFile1, $pathFile2), 200);
        }
        return response('No se pudo guardar el documento', 500);
        //Storage::disk('local')->put('example.txt', 'Contents');
    }

    public function descargarReportePDF(Request $request) {
        $data = $this->consultaSimpatizantes($request);
        $pdf = PDF::loadView('reportes.tablaSimpatizantes', ['data' => $data])->setPaper('a4', 'landscape');
        // download PDF file with download method
        return $pdf->stream('pdf_file.pdf');
    }

    public function descargarReporteXLSX(Request $request) {
        $data = $this->consultaSimpatizantes($request);
        $export = new SimpatizantesExport($data);
    
        return Excel::download($export, 'simpatizantes.xlsx');
    }

    function consultaSimpatizantes(Request $request) {
        $strFiltros = '';
        $arrayValoresFiltros = array();
        if($request->idSimpatizante != '') {
            $strFiltros .= ' AND simp.idSimpatizante = ?';
            array_push($arrayValoresFiltros, $request->idSimpatizante);
        }

        if($request->nombre != '') {
            $strFiltros .= " AND concat(ifnull(simp.nombre,''), ' ', ifnull(simp.apellidoPaterno,''), ' ', ifnull(simp.apellidoMaterno,''), ' ', ifnull(simp.curp,''), ' ', ifnull(simp.claveElector,''), ' ', ifnull(simp.numeroElector,'')) regexp ?";
            array_push($arrayValoresFiltros, str_replace(' ', '|', $request->nombre));
        }

        if($request->idPromotor != '') {
            $strFiltros .= ' AND simp.idPromotor = ?';
            array_push($arrayValoresFiltros, $request->idPromotor);
        }

        if($request->idSeccion != '') {
            $strFiltros .= ' AND simp.idSeccion = ?';
            array_push($arrayValoresFiltros, $request->idSeccion);
        }

        if($request->idLocalidad != '') {
            $strFiltros .= ' AND simp.idLocalidad = ?';
            array_push($arrayValoresFiltros, $request->idLocalidad);
        }

        if($request->fechaInicio != '') {
            $strFiltros .= ' AND simp.fechaHoraAlta >= ?';
            array_push($arrayValoresFiltros, "$request->fechaInicio 00:00:00");
        }

        if($request->fechaFin != '') {
            $strFiltros .= ' AND simp.fechaHoraAlta <= ?';
            array_push($arrayValoresFiltros, "$request->fechaFin 23:59:59");
        }

        if($request->fechaInicio != '') {
            $strFiltros .= ' AND simp.fechaHoraAlta >= ?';
            array_push($arrayValoresFiltros, "$request->fechaInicio 00:00:00");
        }

        if($request->fechaFin != '') {
            $strFiltros .= ' AND simp.fechaHoraAlta <= ?';
            array_push($arrayValoresFiltros, "$request->fechaFin 23:59:59");
        }

        $data = DB::select(
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
                ifnull(date_format(simp.fechaHoraAlta, '%d/%b/%Y %T'), '') fechaHoraAlta,
                ifnull(sec.claveSeccion, '') claveSeccion,
                ifnull(claveLocalidad, '') claveLocalidad,
                ifnull(loc.localidad, '') localidad,
                CONCAT(prom.nombre, ' ', prom.apellidoMaterno, ' ', prom.apellidoPaterno) promotor,
                ifnull(GROUP_CONCAT(docs.url SEPARATOR '|sep|'), '') as docsURL,
                ifnull(GROUP_CONCAT(docs.nombre SEPARATOR '|sep|'), '') as docsNames
            FROM
                tblsimpatizante AS simp
                    LEFT JOIN
                tblseccion AS sec USING (idSeccion)
                    LEFT JOIN
                tbllocalidad AS loc USING (idLocalidad)
                    LEFT JOIN
                tblsimpatizante as prom on prom.idSimpatizante = simp.idPromotor
                    LEFT JOIN
                tblsimpatizantedocumento as docs on docs.idSimpatizante = simp.idSimpatizante
            WHERE ifnull(simp.bitPromotor,0) <> 1
            $strFiltros
            GROUP BY idSimpatizante", $arrayValoresFiltros);

        return $data;
    }
}
