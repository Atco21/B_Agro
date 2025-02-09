<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Explotacion;

class TrabajadorController extends Controller
{
    public function index()
    {
        $explotacion = Explotacion::all();
        $trabajadores = Trabajador::all();
        return view('trabajadores', compact('trabajadores'), compact('explotacion'));


    }


}
