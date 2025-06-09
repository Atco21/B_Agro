<?php

namespace App\Http\Controllers;
use App\Models\Incidencia;
use App\Models\Orden;

use Illuminate\Http\Request;

class IncidenciaController extends Controller{

    public function incidenciasPersonal(){
        $incidenciasPendientes = Incidencia::where('tipo', 'personal')->get();
        return response()->json($incidenciasPendientes);
    }

    public function incidenciasMaquina(){
        $incidenciasMaquina = Incidencia::where('tipo', 'maquina')->get();
        return response()->json($incidenciasMaquina);
    }

    public function incidenciasStock(){
        $incidenciasStock = Incidencia::where('tipo', 'stock')->get();
        return response()->json($incidenciasStock);
    }

    public function incidenciaPorExplotacion($id){

    $incidencias = Incidencia::where('explotacion_id', $id)->where('estado', 'Pendiente')
            ->with([
                'orden',
                'orden.parcela',
                'orden.maquina',
                'orden.tratamiento',
                'orden.aplicadores',
            ])
            ->get();

    return response()->json($incidencias);
    }

        public function update(Request $request, $id)
    {

        $incidencia = Incidencia::findOrFail($id);

        $data = $request->validate([
            'solucion' => 'sometimes|string',
            'estado'   => 'sometimes|string|in:Pendiente,Pausada,Resuelta',
        ]);

        $incidencia->update($data);

        return response()->json($incidencia, 200);
    }
}
