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
    public function almacen($id) {
        $explotacion = Explotacion::find($id);
    
        if (!$explotacion) {
            return response()->json(['error' => 'Explotación no encontrada'], 404);
        }
    
        // Obtener almacenes de la explotación con los químicos asociados
        $almacenes = Almacen::where('id_explotacion', $id)
            ->with(['quimicos' => function ($query) {
                $query->select('quimicos.id', 'quimicos.nombre', 'almacen_quimico.cantidad');
            }])
            ->get();
    
        return response()->json([
            'explotacion' => $explotacion->nombre,
            'almacenes' => $almacenes
        ], 200);
    }
    
    


    public function mostrarAlmacenQuimico(){

        $explotaciones = Explotacion::find(1);

        $almacen=Almacen::find($explotaciones->id);
        $quimicos=Almacen::find($almacen->id)->quimicos;
        return $quimicos;


        // $quimico = Quimico::find(1);
        // $almacenes = $quimico->nombre;
        // foreach($almacenes as $almacen){
        //     dd($almacen);
        // }
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
