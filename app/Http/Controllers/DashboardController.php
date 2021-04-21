<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        if($request->session()->get('nivelAcceso') == 'admin') {
            return view('consultas.consultaSimpatizantes', ['session' => $request->session()]);
        } else {
            return view('catalogos.simpatizantes', ['session' => $request->session()]);
        }
    }
}
