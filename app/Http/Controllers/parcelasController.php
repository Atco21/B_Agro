<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;
use App\Models\Explotacion;

class ParcelasController extends Controller
{
    public function index()
    {
        return response()->json(Parcela::all());
    }

    public function show($id)
    {
        return response()->json(Parcela::findOrFail($id));
    }

    public function store(Request $request)
    {
        $parcela = Parcela::create($request->validate([
            'explotacion_id' => 'required|exists:explotaciones,id',
            'cultivo_id' => 'required|exists:cultivos,id',
            'nombre' => 'nullable|string|max:255',
            'area' => 'nullable|numeric|min:0',
        ]));

        return response()->json($parcela, 201);
    }

    public function update(Request $request, $id)
    {
        $parcela = Parcela::findOrFail($id);
        $parcela->update($request->validate([
            'explotacion_id' => 'sometimes|exists:explotaciones,id',
            'cultivo_id' => 'sometimes|exists:cultivos,id',
            'nombre' => 'nullable|string|max:255',
            'area' => 'nullable|numeric|min:0',
        ]));

        return response()->json($parcela);
    }

    public function destroy($id)
    {
        Parcela::findOrFail($id)->delete();
        return response()->json(null, 204);
    }


    public function porExplotacion($explotacion_id){

        $parcelas = Parcela::where('explotacion_id', $explotacion_id)->get();
        return response()->json($parcelas);
    }



    public function listarParcelasPorExplotacion()
    {
        $explotacion = Explotacion::all();

        return view('explotaciones.parcelas', ['explotacion'=>$explotacion]);


    }

    public function getDatosPorExplotacion($id){

        $explotacion = Explotacion::find($id);

        if (!$explotacion) {
            return response()->json(['error' => 'Explotación no encontrada'], 404);
        }

        return response()->json([
            'id' => $explotacion->id,
            'nombre' => $explotacion->nombre,
            'direccion' => $explotacion->direccion,
            'localidad' => $explotacion->localidad,
            'tamaño' => $explotacion->tamanyo
        ]);


    }

    public function rendimiento(){


        return view('explotacion');


    }


}
