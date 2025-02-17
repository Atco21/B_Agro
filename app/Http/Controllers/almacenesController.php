<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;
use App\Models\Explotacion;

class almacenesController extends Controller
{
    public function mostrarAlmacen(){
        $almacenes = Almacen::all();
        return view('explotacion.almacen', compact('almacenes'));
    }

    public function porExplotacion($explotacion_id)
{
    // Obtener los almacenes de la explotación con los productos químicos
    $almacenes = Almacen::with('quimicos')->where('id_explotacion', $explotacion_id)->get();

    if ($almacenes->isEmpty()) {
        return response()->json(['error' => 'No se encontraron almacenes para esta explotación'], 404);
    }

    return response()->json($almacenes);
}


}
