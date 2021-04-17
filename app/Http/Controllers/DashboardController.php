<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        return view('consultas.consultaSimpatizantes', ['session' => $request->session()]);
    }
}
