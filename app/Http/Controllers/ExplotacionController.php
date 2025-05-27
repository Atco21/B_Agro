<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;
use App\Models\Maquina;
use App\Models\Orden;
use App\Models\Almacen;
use App\Models\Incidencia;




class ExplotacionController extends Controller
{
    public function index(Request $request)
    {
        $explotacion = Explotacion::all();
        return view('explotacion', compact('explotacion'));
    }

    public function editar(Request $request)
    {
        $explotacion = Explotacion::all();
        return view('editarExplotaciones', compact('explotacion'));
    }

    public function general()
    {
        $explotacion = Explotacion::all();

        $ordenes = Orden::all();
        $todasOrdenes = [
            'pendientes' => 0,
            'enCurso' => 0,
            'pausadas' => 0,
            'completadas' => 0,
        ];
        foreach ($ordenes as $orden) {

            switch ($orden->estado) {
                case 'Pendiente':
                    $todasOrdenes['pendientes']++;
                    break;
                case 'En curso':
                    $todasOrdenes['enCurso']++;
                    break;
                case 'Pausada':
                    $todasOrdenes['pausadas']++;
                    break;
                case 'Completada':
                    $todasOrdenes['completadas']++;
                    break;
            }
        }
        $quimicosPeligro = collect();
        foreach ($explotacion as $exp) {
            foreach ($exp->almacenes as $almacen) {
                $quimicos = \App\Models\AlmacenQuimico::where('almacen_id', $almacen->id)
                    ->with('quimico')
                    ->whereColumn('stock', '<', 'stock_minimo')
                    ->get();

                $quimicosPeligro = $quimicosPeligro->merge($quimicos);
            }
        }


        $incidencias = Incidencia::with('orden')->get();
        $incidenciasCounts = [];
        foreach ($incidencias as $inc) {
        $expId = $inc->orden->explotacion_id;
        $incidenciasCounts[$expId] = ($incidenciasCounts[$expId] ?? 0) + 1;
    }


        return view('explotaciones.general', compact('explotacion', 'todasOrdenes', 'quimicosPeligro', 'incidenciasCounts'));


    }

public function incidencias()
{
    $explotacion = Explotacion::all();

    // Todas las incidencias (con la relación a orden para acceder a explotacion_id)
    $incidencias = Incidencia::with('orden')->get();

    // Contadores por tipo para cada explotación
    $incidenciasCounts = [];
    foreach ($incidencias as $inc) {
        $expId = $inc->orden->explotacion_id;

        if (! isset($incidenciasCounts[$expId])) {
            $incidenciasCounts[$expId] = [
                'personal' => 0,
                'stock'    => 0,
                'maquina'  => 0,
            ];
        }

        // Incrementa según el tipo de incidencia
        $incidenciasCounts[$expId][$inc->tipo]++;
    }

    return view(
        'explotaciones.incidencias',
        compact('explotacion', 'incidenciasCounts')
    );
}

    public function maquinas(){
        $explotacion = Explotacion::all();
        $maquinas = Maquina::all();
        return view('explotaciones.maquinas', compact('explotacion'), compact('maquinas'));
    }

    public function almacen(){
        $explotacion = Explotacion::all();
        $almacenes =  Almacen::with(['explotacion', 'quimicosEnPeligro.quimico'])->get();
        return view('explotaciones.almacen', compact('explotacion'), compact('almacenes'));
    }

    public function index2(Request $request)
    {
        $explotacion = Explotacion::all();
        return $explotacion;
    }

    public function parcelas()
    {
        $explotacion = Explotacion::all();
        return view('explotaciones.parcelas', compact('explotacion'));
    }

}
