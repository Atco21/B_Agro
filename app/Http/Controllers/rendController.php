<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;
use App\Models\Explotacion;
use App\Models\Rendimiento;


class rendController extends Controller
{
        public function mostrarParcela($id)
        {
            $parcela = Rendimiento::where('parcela_id',$id)->get();

            if (!$parcela) {
                return response()->json(['error' => 'Parcela no encontrada'], 404);
            }

            return response()->json($parcela);
        }
}


