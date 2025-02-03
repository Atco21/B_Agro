<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cultivo;

class cultivoController extends Controller
{
    public function getNombres(Request $request)
    {
        // Obtener IDs de la URL en formato "1,2,3"
        $ids = explode(",", $request->query('ids'));

        // Buscar los cultivos en la base de datos
        $cultivos = Cultivo::whereIn('id', $ids)->pluck('nombre', 'id');

        return response()->json($cultivos);
    }

}
