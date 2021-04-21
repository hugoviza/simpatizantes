<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalidadesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.localidades', ['session' => $request->session()]);
    }

    public function listar(Request $request) {
        if(isset($request->idLocalidad)) {
            $localidades = DB::select('SELECT * from tbllocalidad WHERE idLocalidad = ? order by localidad', [$request->idLocalidad]);
        } else {
            $localidades = DB::select('SELECT * from tbllocalidad order by localidad');
        }
        return response()->json($localidades, 200);
    }

    public function guardar(Request $request) {
        //Validamos que nos estén enviando todos los datos
        // if($request->claveLocalidad == "") {
        //     return response("Ingrese clave de localidad", 400);
        // }

        if($request->localidad == "") {
            return response("Ingrese descripción localidad", 400);
        }

        // //Primero validamos si la claveLocalidad ya existe
        // if($request->idLocalidad != "") {
        //     $localidadesDuplicadas = DB::select('SELECT * from tbllocalidad WHERE claveLocalidad = ? AND idLocalidad <> ?', [$request->claveLocalidad, $request->idLocalidad]);
            $localidades = DB::select('SELECT * from tbllocalidad WHERE idLocalidad = ?', [$request->idLocalidad]);
        // } else {
        //     $localidadesDuplicadas = DB::select('SELECT * from tbllocalidad WHERE claveLocalidad = ?', [$request->claveLocalidad]);
        //     $localidades = array();
        // }

        // if(sizeof($localidadesDuplicadas) > 0) {
        //     return response("La clave de localidad ya se encuentra registrada", 400);
        // }

        if(sizeof($localidades) > 0) {
            //Edicion
            DB::update('UPDATE tbllocalidad set claveLocalidad = ?, localidad = ? where idLocalidad = ?', [
                $request->claveLocalidad,
                $request->localidad,
                $request->idLocalidad
            ]);

            return response("Localidad editada correctamente", 200);
        } else {
            //insert
            DB::insert(
                'INSERT INTO tbllocalidad 
                    (claveLocalidad, localidad) values
                    (?, ?)', [
                        $request->claveLocalidad,
                        $request->localidad]
            );
            
            return response("Localidad creada correctamente", 200);
        }
    }

    public function eliminar(Request $request) {
        //Validamos que nos estén enviando todos los datos
        if($request->idLocalidad == "") {
            return response("Seleccione localidad por eliminar", 400);
        }

        //Validamos que exista la localidad
        $localidades = DB::select('SELECT * from tbllocalidad WHERE idLocalidad = ?', [$request->idLocalidad]);
        if(sizeof($localidades) == 0) {
            return response("La localidad no existe", 400);
        }

        //validamos que la localidad no este en uso
        $simpatizantes = DB::select('SELECT count(*) AS totalSimpatizantes from tblsimpatizante WHERE idLocalidad = ?', [$request->idLocalidad]);

        if($simpatizantes[0]->totalSimpatizantes == 0) {
            DB::delete('DELETE FROM tbllocalidad WHERE idLocalidad = ?', [$request->idLocalidad]);
            return response("Localidad eliminada correctamente", 200);
        } else {
            return response("No es posible eliminar a la localidad seleccionada, la localidad contiene {$simpatizantes[0]->totalSimpatizantes} simpatizantes registrados", 400);
        }
    }

    public function autocomplete(Request $request) {
        $busqueda = str_replace(' ', '|', $request->txtBusqueda);
        $resultados = DB::select(
            "SELECT 
                CONCAT(claveLocalidad, ' ', localidad) AS label,
                idLocalidad AS value
            FROM
                tbllocalidad
            WHERE
                CONCAT(claveLocalidad, ' ', localidad) REGEXP '$busqueda'
            order by localidad;"
        );

        return response()->json($resultados, 200);
    }
}
