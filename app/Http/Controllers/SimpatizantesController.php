<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpatizantesController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.simpatizantes', ['session' => $request->session()]);
    }
}
