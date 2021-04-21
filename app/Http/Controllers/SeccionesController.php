<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeccionesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.secciones', ['session' => $request->session()]);
    }

    public function listar(Request $request) {
        if(isset($request->idSeccion)) {
            $secciones = DB::select('SELECT * from tblseccion WHERE idSeccion = ? order by claveSeccion', [$request->idSeccion]);
        } else {
            $secciones = DB::select('SELECT * from tblseccion order by claveSeccion');
        }
        return response()->json($secciones, 200);
    }

    public function guardar(Request $request) {
        //Validamos que nos estén enviando todos los datos

        if($request->claveSeccion == "") {
            return response("Ingrese clave sección", 400);
        }

        //Primero validamos si la clave ya existe
        if($request->idSeccion != "") {
            $seccionesDuplicadas = DB::select('SELECT * from tblseccion WHERE claveSeccion = ? AND idSeccion <> ?', [$request->claveSeccion, $request->idSeccion]);
            $secciones = DB::select('SELECT * from tblseccion WHERE idSeccion = ?', [$request->idSeccion]);
        } else {
            $seccionesDuplicadas = DB::select('SELECT * from tblseccion WHERE claveSeccion = ?', [$request->claveSeccion]);
            $secciones = array();
        }

        if(sizeof($seccionesDuplicadas) > 0) {
            return response("La clave de sección ya se encuentra registrada", 400);
        }

        if(sizeof($secciones) > 0) {
            //Edicion
            DB::update('UPDATE tblseccion set claveSeccion = ? where idSeccion = ?', [
                $request->claveSeccion,
                $request->idSeccion
            ]);

            return response("Sección editada correctamente", 200);
        } else {
            //insert
            DB::insert(
                'INSERT INTO tblseccion 
                    (claveSeccion) values
                    (?)', [$request->claveSeccion]
            );
            
            return response("Sección creada correctamente", 200);
        }
    }

    public function eliminar(Request $request) {
        //Validamos que nos estén enviando todos los datos
        if($request->idSeccion == "") {
            return response("Seleccione sección por eliminar", 400);
        }

        //Validamos que exista la localidad
        $secciones = DB::select('SELECT * from tblseccion WHERE idSeccion = ?', [$request->idSeccion]);
        if(sizeof($secciones) == 0) {
            return response("La sección no existe", 400);
        }

        //validamos que la localidad no este en uso
        $simpatizantes = DB::select('SELECT count(*) AS totalSimpatizantes from tblsimpatizante WHERE idSeccion = ?', [$request->idSeccion]);

        if($simpatizantes[0]->totalSimpatizantes == 0) {
            DB::delete('DELETE FROM tblseccion WHERE idSeccion = ?', [$request->idSeccion]);
            return response("Sección eliminada correctamente", 200);
        } else {
            return response("No es posible eliminar a la sección seleccionada, la sección contiene {$simpatizantes[0]->totalSimpatizantes} simpatizantes registrados", 400);
        }
    }

    public function autocomplete(Request $request) {
        $resultados = DB::select(
            "SELECT 
                claveSeccion AS label, idSeccion AS value
            FROM
                tblseccion
            WHERE
                claveSeccion LIKE '%$request->txtBusqueda%';"
        );

        return response()->json($resultados, 200);
    }
}
