<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;

class explotacionController extends Controller
{
    public function index(Request $request)
    {
        $explotacion = Explotacion::all();
        // $explotacion = [];
        return view('explotacion', ['explotacion' => $explotacion]);
    }

    public function general()
    {
        $explotacion = Explotacion::all();
        return view('explotaciones.general', ['explotacion' => $explotacion]);
    }
}
