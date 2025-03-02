<?php

namespace App\Http\Controllers;
use App\Models\Incidencia;
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
}
