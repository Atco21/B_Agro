<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cultivo;

class cultivoController extends Controller
{
    public function getNombre($id)
    {
        $cultivo = Cultivo::find($id);

        if (!$cultivo) {
            return response()->json(["error" => "Cultivo no encontrado"], 404);
        }

        return response()->json(["nombre" => $cultivo->nombre]);
    }


    public function getNombres(Request $request)
    {
        $ids = explode(",", $request->query('ids'));


        // Buscar los cultivos en la base de datos
        $cultivos = Cultivo::whereIn('id', $ids)->pluck('nombre', 'id');

        return response()->json($cultivos);
    }
}
