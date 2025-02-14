<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;

class almacenesController extends Controller
{
    public function mostrarAlmacen(){
        $almacenes = Almacen::all();
        return view('explotacion.almacen', compact('almacenes'));
    }
}
