<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;
use App\Models\Maquina;


class ExplotacionController extends Controller
{
    public function index(Request $request)
    {
        $explotacion = Explotacion::all();
        // $explotacion = [];
        return view('explotacion', compact('explotacion'));
    }

    public function editar(Request $request)
    {
        $explotacion = Explotacion::all();


        return view('editarExplotaciones', compact('explotacion'));
    }

    public function general()
    {
        $explotacion = Explotacion::all();
        return view('explotaciones.general', compact('explotacion'));
    }


    public function ordenes(){
        $explotacion = Explotacion::all();
        return view('explotaciones.ordenes', compact('explotacion'));
    }
    public function incidencias(){
        $explotacion = Explotacion::all();
        return view('explotaciones.incidencias', compact('explotacion'));
    }

    public function maquinas(){
        $explotacion = Explotacion::all();
        $maquinas = Maquina::all();
        return view('explotaciones.maquinas', compact('explotacion'), compact('maquinas'));
    }

    public function pedidos(){
        $explotacion = Explotacion::all();
        return view('explotaciones.pedidos', compact('explotacion'));
    }



    public function index2(Request $request)
    {
        $explotacion = Explotacion::all();

        return $explotacion;
    }

    public function parcelas()
    {
        $explotacion = Explotacion::all();
        return view('explotaciones.parcelas', compact('explotacion'));
    }


}
