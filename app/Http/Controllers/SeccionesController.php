<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeccionesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.secciones', ['session' => $request->session()]);
    }
}
