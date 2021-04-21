<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request) {
        if($request->session()->get('nivelAcceso') == 'admin') {
            $localidades = DB::select('SELECT count(*) as totalLocalidades from tbllocalidad');
            $secciones = DB::select('SELECT count(*) as totalSecciones from tblseccion');
            $simpatizantes = DB::select('SELECT count(*) as totalSimpatizantes from tblsimpatizante WHERE bitPromotor <> 1');
            $promotores = DB::select('SELECT count(*) as totalPromotores from tblsimpatizante WHERE bitPromotor = 1');


            return view('consultas.consultaSimpatizantes', [
                'session' => $request->session(),
                'totalLocalidades' => $localidades[0]->totalLocalidades,
                'totalSecciones' => $secciones[0]->totalSecciones,
                'totalSimpatizantes' => $simpatizantes[0]->totalSimpatizantes,
                'totalPromotores' => $promotores[0]->totalPromotores,
                ]);
        } else {
            return view('catalogos.simpatizantes', ['session' => $request->session()]);
        }
    }
}
