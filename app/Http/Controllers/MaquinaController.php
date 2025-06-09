<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maquina;
use App\Models\Explotacion;



class MaquinaController extends Controller
{
    public function index()
    {
        $maquinas = Maquina::all();
        return response()->json($maquinas);
    }

    public function show($id)
    {
        $maquina = Maquina::find($id);
        return response()->json($maquina);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'explotacion_id' => 'required|integer|exists:explotaciones,id',
            'nombre' => 'required|string|max:255',
            'matricula'=> 'required|string|max:255',
            'capacidad'=> 'nullable|double|min:1',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }

        $maquina = Maquina::create([
            'nombre' => $request->nombre,
            'matricula' => $request->matricula,
            'explotacion_id' => $request->explotacion_id,
            'capacidad' => $request->capacidad,


        ]);
        return redirect()->route('explotaciones.maquinas')->with('success', 'Trabajador registrado correctamente.');

    }

    public function update(Request $request)
    {

        $id = $request->maquina_id;
        $maquina = Maquina::findOrFail($id);
        $maquina->update($request->all());
        return redirect()->route('explotaciones.maquinas')->with('success', 'Maquina actualizada correctamente');    }

    public function delete(Request $request, $id)
    {
        $maquina = Maquina::findOrFail($id);
        $maquina->delete();
        return response()->json(null, 204);
    }


    public function mostrarMaquinasPorExplotacion($explotacion_id){

        $maquinas = Maquina::where('explotacion_id', $explotacion_id)->get();
        return response()->json($maquinas);;
    }

    public function buscarPorId($id){
        $maquina = Maquina::find($id);
        return response()->json($maquina);
    }
    public function destroy($id)
    {
        $maquina = Maquina::findOrFail($id);
        $maquina->delete();

        return back()->with('success', 'Máquina eliminada correctamente.');
    }



}
