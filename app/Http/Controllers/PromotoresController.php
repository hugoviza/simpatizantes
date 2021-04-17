<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotoresController extends Controller
{
    public function index(Request $request) {
        return view('catalogos.promotores', ['session' => $request->session()]);
    }
}
