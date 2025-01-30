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

    public function parcelas(){
        $explotacion = Explotacion::all();
        return view('explotaciones.parcelas', ['explotacion' => $explotacion]);
    }
    public function tareas(){
        $explotacion = Explotacion::all();
        return view('explotaciones.tareas', ['explotacion' => $explotacion]);
    }
    public function incidencias(){
        $explotacion = Explotacion::all();
        return view('explotaciones.incidencias', ['explotacion' => $explotacion]);
    }
    public function maquinas(){
        $explotacion = Explotacion::all();
        return view('explotaciones.maquinas', ['explotacion' => $explotacion]);
    }




    public function index2(Request $request)
    {
        $explotacion = Explotacion::all();

        return $explotacion;
    }



}
