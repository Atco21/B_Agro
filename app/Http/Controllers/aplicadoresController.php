<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplicador;  // Asegúrate de que el nombre del modelo esté correcto

class AplicadoresController extends Controller
{
    public function index(){
        // Obtener todos los aplicadores
        $aplicadores = Aplicador::all();

        // Pasar la variable correctamente a la vista
        return view('aplicador', compact('aplicadores'));
    }
}
