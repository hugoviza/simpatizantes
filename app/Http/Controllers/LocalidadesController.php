<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalidadesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.localidades', ['session' => $request->session()]);
    }
}
