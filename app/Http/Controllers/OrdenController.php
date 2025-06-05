<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Aplicadores;
use App\Models\Explotacion;
use Illuminate\Http\Request;


use PDF;


class OrdenController extends Controller
{
    /**
     * Muestra una lista de órdenes.
     */
    public function index()
    {
        $explotaciones = Explotacion::all();
        $ordenes = Orden::all();

        $totalOrdenes = [];
        $todasOrdenesExplotacion = [
            'Pendientes' => 0,
            'En curso' => 0,
            'Pausadas' => 0,
            'Completadas' => 0,
        ];

        foreach ($ordenes as $orden) {
            $idExplotacion = $orden->explotacion_id;

            if (!isset($totalOrdenes[$idExplotacion])) {
                $totalOrdenes[$idExplotacion] = [
                    'Pendientes' => 0,
                    'En curso' => 0,
                    'Pausadas' => 0,
                    'Completadas' => 0,
                ];
            }

            // Contar según el estado
            switch ($orden->estado) {
                case 'Pendiente':
                    $totalOrdenes[$idExplotacion]['Pendientes']++;
                    $todasOrdenesExplotacion['Pendientes']++;
                    break;
                case 'En curso':
                    $totalOrdenes[$idExplotacion]['En curso']++;
                    $todasOrdenesExplotacion['En curso']++;

                    break;
                case 'Pausada':
                    $totalOrdenes[$idExplotacion]['Pausadas']++;
                    $todasOrdenesExplotacion['Pausadas']++;

                    break;
                case 'Completada':
                    $totalOrdenes[$idExplotacion]['Completadas']++;
                    $todasOrdenesExplotacion['Completadas']++;
                    break;
            }
        }


        return view('explotaciones.ordenes', ['explotacion'=>$explotaciones, 'ordenes'=>$totalOrdenes]);
    }

    /**
     * Almacena una nueva orden en la base de datos.
     */
 public function store(Request $request)
    {
        $validated = $request->validate([
            'estado'           => 'required|in:Pendiente,En curso,Pausada,Completada',
            'fecha_inicio'     => 'nullable|date',
            'fecha_fin'        => 'nullable|date',
            'tarea'            => 'required|string|max:255',
            'jefecampo_id'     => 'nullable|exists:users,id',
            'aplicador_id1'    => 'required|exists:users,id',
            'aplicador_id2'    => 'nullable|exists:users,id',
            'aplicador_id3'    => 'nullable|exists:users,id',
            'aplicador_id4'    => 'nullable|exists:users,id',
            'parcela_id'       => 'required|exists:parcelas,id',
            'id_tratamiento'   => 'nullable|exists:tratamientos,id',
            'id_maquina'       => 'nullable|exists:maquina,id',
            'explotacion_id'   => 'required|exists:explotaciones,id',
        ]);

        // Crea la orden directamente usando los campos validados
        $orden = Orden::create($validated);


    // Solo devolvemos el modelo recién creado, con código HTTP 201
    return response()->json($orden, 201);
    }


    public static function obtenerIdYAsunto()
    {
        return self::select('parcela_id', 'tarea')->get();
    }


    /**
     * Muestra una orden específica.
     */
    public function show($id)
    {
        $orden = Orden::findOrFail($id);
        return response()->json($orden);
    }

    /**
     * Actualiza una orden en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);

        $request->validate([
            'estado' => 'sometimes|string|max:50',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'id_administrador' => 'sometimes|exists:trabajadores,id',
            'tarea' => 'sometimes|string|max:255',
            'id_jefecampo' => 'sometimes|exists:trabajadores,id',
            'aplicador_id' => 'sometimes|exists:trabajadores,id',
            'parcela_id' => 'sometimes|exists:parcelas,id',
            'id_tratamiento' => 'sometimes|exists:tratamientos,id',
            'id_maquina' => 'nullable|exists:maquinas,id',
        ]);

        $orden->update($request->all());
        return response()->json($orden);
    }

    /**
     * Elimina una orden de la base de datos.
     */
    public function destroy($id)
    {
        $orden = Orden::findOrFail($id);
        $orden->delete();
        return response()->json(['message' => 'Orden eliminada correctamente']);
    }

     public function insertarTablaIntermedia(){
        $orden=Orden::find(1);
        $aplicador = Trabajador::find(2);
        $orden->aplicadores()->attach($aplicador);
    }


    public function actualizarDatosdeApi(Request $request)
    {
        dd($request->all());

        $request->validate([
            'estado' => 'required|string|max:50',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'id_administrador' => 'required|exists:trabajadores,id',
            'tarea' => 'required|string|max:255',
            'id_jefecampo' => 'required|exists:trabajadores,id',
            'aplicador_id' => 'required|exists:trabajadores,id',
            'parcela_id' => 'required|exists:parcelas,id',
            'id_tratamiento' => 'required|exists:tratamientos,id',
            'id_maquina' => 'nullable|exists:maquinas,id',
        ]);

        $orden = Orden::create($request->all());
        return response()->json($orden, 201);
    }
    public function ordenesPendientes()
    {


    $ordenesPendientes = Orden::where('estado', 'pendiente')->with('parcela')->get();
    return response()->json($ordenesPendientes)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");




    }
public function ordenesCurso()
    {
     $ordenesCurso = Orden::where('estado', 'en curso')->with('parcela')->get();
    return response()->json($ordenesCurso)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }


//pasado
public function ordenesPausa()
    {
     $ordenesPausa = Orden::where('estado', 'pausada')->with('parcela')->get();
    return response()->json($ordenesPausa)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }

    public function ordenById($id)
    {
     $orden = Orden::where('id', $id)->with('parcela')->with('aplicadores')->get();
    return response()->json($orden)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }



    //terminada

public function ordenesTerminadas()
    {
     $ordenesTerminada = Orden::where('estado', 'completada')->with('parcela')->get();
    return response()->json($ordenesTerminada)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }

    //cancelada


    public function mostrarOrdenesPorExplotacion($id)
    {
        $ordenes = Orden::where('explotacion_id', $id)->with('parcela')->with('explotacion')->with('maquina')->with('aplicadores')->with('tratamiento')->get();
        return response()->json($ordenes)
        ->header("Access-Control-Allow-Origin", "*")
        ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
        ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }







    public function generarPdf(Request $request)
    {
        // 1. Validar las fechas y el ID de explotación
        $request->validate([
            'fecha_inicio'    => 'required|date',
            'fecha_fin'       => 'required|date|after_or_equal:fecha_inicio',
            'explotacion_id'  => 'required|exists:explotaciones,id',
        ]);

        $fechaInicio     = $request->input('fecha_inicio');
        $fechaFin        = $request->input('fecha_fin');
        $explotacionId   = $request->input('explotacion_id');

        $ordenes = Orden::where('explotacion_id', $explotacionId)
            ->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
            ->where('estado', 'Completada')
            ->whereNotNull('id_tratamiento')
            ->with('tratamiento') // se cargará correctamente
            ->orderBy('fecha_inicio', 'asc')
            ->get();


        // 3
        $explotacion = Explotacion::find($explotacionId);

        $pdf = PDF::loadView('pdf.ordenes', compact('ordenes', 'fechaInicio', 'fechaFin', 'explotacion'));

        // 5. Descargar el PDF (o devolver inline, según prefieras)
        return $pdf->download('informe_ordenes_'.$explotacion->nombre.'_'.$fechaInicio.'_a_'.$fechaFin.'.pdf');
    }

}



