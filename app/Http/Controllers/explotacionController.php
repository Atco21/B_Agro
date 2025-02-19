<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;
use App\Models\Almacen;
use App\Models\Quimico;

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
    public function almacen(Request $recibido) {
        $explotacion = Explotacion::find($recibido);
        $almacenes = Almacen::find($explotacion); // Cargar todos los almacenes
        $quimicos = $almacenes->quimico();
        return view('explotaciones.almacen',
        [ 'explotacion' => $explotacion,
        'almacenes' => $almacenes,
        'quimicos' => $quimicos ]
    );
        }


    public function mostrarAlmacenQuimico(){

        $explotaciones = Explotacion::find($valor);

        $almacen=Almacen::find(1);
        $quimicos=$almacen->quimicos;


        $quimico = Quimico::find(1);
        $almacenes = $quimico->nombre;
        foreach($almacenes as $almacen){
            dd($almacen);
        }
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
