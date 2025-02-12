<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quimico;

class quimicosController extends Controller
{

    public function mostrarQuimicos(){
        $quimicos = Quimico::all();
    //return view('quimicos', compact('quimicos'));
    return response()->json($quimicos, 200);
    }
}
