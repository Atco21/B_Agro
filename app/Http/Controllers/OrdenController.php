<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Aplicadores;
use App\Models\Explotacion;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Muestra una lista de órdenes.
     */
    public function index()
    {
        $ordenes = Orden::with('parcela')->get();
        return response()->json($ordenes);
    }

    /**
     * Almacena una nueva orden en la base de datos.
     */
    public function store(Request $request)
    {




        $request->validate([
            'estado' => 'nullable|string|max:50',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'tarea' => 'ç
            o|string|max:255',
            'jefecampo_id' => 'nullable|integer|exists:users,id',
            'aplicador_id' => 'nullable|integer|exists:users,id',
            'parcela_id' => 'nullable|integer|exists:parcelas,id',
            'id_tratamiento' => 'nullable|integer|exists:tratamientos,id',
            'id_maquina' => 'nullable|integer|exists:maquinas,id',
        ]);




        $orden = Orden::create($request->all());
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
     //INSERTAR Tabla intermedia de orden y aplicador que es muchos a muchos M/M

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
     $ordenesCurso = Orden::where('estado', 'encurso')->with('parcela')->get();
    return response()->json($ordenesCurso)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }


//pasado
public function ordenesPausa()
    {
     $ordenesPausa = Orden::where('estado', 'pasado')->with('parcela')->get();
    return response()->json($ordenesPausa)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }

    //terminada

public function ordenesTerminadas()
    {
     $ordenesTerminada = Orden::where('estado', 'terminada')->with('parcela')->get();
    return response()->json($ordenesTerminada)
    ->header("Access-Control-Allow-Origin", "*")
    ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    ->header("Access-Control-Allow-Headers", "Content-Type, Authorization");
    }

    //cancelada

}



