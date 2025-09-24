<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;
use App\Models\Maquina;
use App\Models\Orden;
use App\Models\Almacen;
use App\Models\Incidencia;
use App\Models\Cultivo;
use App\Models\AlmacenQuimico;
use App\Models\Parcela;



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


        $incidencias = Incidencia::with('orden')->where('estado', 'Pendiente')->get();
        $incidenciasCounts = [];
        foreach ($incidencias as $inc) {
            $expId = $inc->orden->explotacion_id;
            $incidenciasCounts[$expId] = ($incidenciasCounts[$expId] ?? 0) + 1;
        }
        $cultivos = [];

        return view('explotaciones.general', compact('explotacion', 'todasOrdenes', 'quimicosPeligro', 'incidenciasCounts', 'cultivos'));


    }

public function incidencias()
{
    $explotacion = Explotacion::all();

    $cultivos = Cultivo::all();

    $incidencias = Incidencia::with('orden')->where('estado', 'Pendiente')->get();

    $incidenciasCounts = [];
    foreach ($incidencias as $inc) {
        $expId = $inc->orden->explotacion_id;

        if (! isset($incidenciasCounts[$expId])) {
            $incidenciasCounts[$expId] = [
                'Personal' => 0,
                'Stock'    => 0,
                'Maquina'  => 0,
            ];
        }

        $incidenciasCounts[$expId][$inc->tipo]++;
    }

    return view(
        'explotaciones.incidencias',
        compact('explotacion', 'incidenciasCounts', 'cultivos')
    );
}

    public function maquinas(){
        $explotacion = Explotacion::all();
        $maquinas = Maquina::all();
        $cultivos = Cultivo::all();

        return view('explotaciones.maquinas', compact('explotacion'), compact('maquinas', 'cultivos'));
    }

    public function almacen(){
        $explotacion = Explotacion::all();
        $cultivos = Cultivo::all();

        $almacenes =  Almacen::with(['explotacion', 'quimicosEnPeligro.quimico'])->get();
        return view('explotaciones.almacen', compact('explotacion'), compact('almacenes', 'cultivos'));
    }

    public function index2(Request $request)
    {
        $explotacion = Explotacion::all();
        return $explotacion;
    }

    public function parcelas()
    {
        $explotacion = Explotacion::all();
        $cultivos = Cultivo::all();

        return view('explotaciones.parcelas', compact('explotacion', 'cultivos'));
    }

    public function store(Request $request)
    {
        // Validar datos de la explotación
        $data = $request->validate([
            'nombre'     => 'required|string|max:255',
            'direccion'  => 'nullable|string|max:255',
            'localidad'  => 'nullable|string|max:255',
            'tamanyo'    => 'nullable|numeric|min:0',
            'parcelas'               => 'nullable|array',
            'parcelas.*.nombre'      => 'required_with:parcelas|string|max:255',
            'parcelas.*.cultivo_id'  => 'required_with:parcelas|exists:cultivos,id',
            'parcelas.*.tamanyo'     => 'required_with:parcelas|numeric|min:0',
        ]);

        // Crear la explotación
        $explotacion = Explotacion::create([
            'nombre'    => $data['nombre'],
            'direccion' => $data['direccion'] ?? null,
            'localidad' => $data['localidad'] ?? null,
            'tamanyo'   => $data['tamanyo']   ?? 0,
        ]);

        // Si vienen parcelas, las guardamos asociadas
        if (! empty($data['parcelas'])) {
            foreach ($data['parcelas'] as $parc) {
                $explotacion->parcelas()->create([
                    'nombre'     => $parc['nombre'],
                    'cultivo_id' => $parc['cultivo_id'],
                    'tamanyo'    => $parc['tamanyo'],
                ]);
            }
        }

        return redirect()
            ->route('explotaciones.general')
            ->with('success', 'Explotación creada correctamente.');
    }

}
