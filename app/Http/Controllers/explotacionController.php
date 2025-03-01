<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;

class explotacionController extends Controller
{
    public function index()
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


    public function ordenes(){
        $explotacion = Explotacion::all();
        return view('explotaciones.ordenes', ['explotacion' => $explotacion]);
    }
    public function incidencias(){
        $explotacion = Explotacion::all();
        return view('explotaciones.incidencias', ['explotacion' => $explotacion]);
    }
    public function maquinas(){
        $explotacion = Explotacion::all();
        return view('explotaciones.maquinas', ['explotacion' => $explotacion]);
    }
    public function pedidos(){
        $explotacion = Explotacion::all();
        return view('explotaciones.pedidos', ['explotacion' => $explotacion]);
    }



    public function index2(Request $request)
    {
        $explotacion = Explotacion::all();

        return $explotacion;
    }

    public function parcelas()
    {
        $explotacion = Explotacion::all();
        return view('explotaciones.parcelas', ['explotacion' => $explotacion]);
    }


}
