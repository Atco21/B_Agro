<?php

namespace App\Http\Controllers;
use App\Models\Tratamiento;

use Illuminate\Http\Request;

class TratamientoController extends Controller{
 public function mostrarTratamientos()
 {
     return response()->json(Tratamiento::all());
 }


 public function show($id)
 {
     $Tratamiento = Tratamiento::find($id_tratamiento);
     if (!$Tratamiento) {
         return response()->json(['message' => 'Tratamiento no encontrado'], 404);
     }
     return response()->json($Tratamiento, 200);
 }

 public function store(Request $request)
 {
     $validatedData = $request->validate([

         'producto_quimico' => 'required|string|max:100',
         'dosis' => 'required|string|max:100',
         'nombre_tratamiento' => 'required|string|max:100',


     ]);

     $tratamiento = Tratamiento::create($validatedData);

     return response()->json($tratamiento, 201);
 }

 public function update(Request $request, $id)
 {
     $tratamiento = Tratamiento::find($id);
     if (!$tratamiento) {
         return response()->json(['message' => 'tratamiento no encontrado'], 404);
     }

     $validatedData = $request->validate([
         'producto_quimico' => 'sometimes|required|string|max:100',
         'dosis' => 'sometimes|required|string|max:100',
         'nombre_tratamiento' => 'sometimes|required|string|max:100',
     ]);

     $tratamiento->update($validatedData);

     return response()->json($tratamiento, 200);
 }

 public function destroy($id)
 {
     $tratamiento = Tratamiento::find($id);
     if (!$tratamiento) {
         return response()->json(['message' => 'tratamiento no encontrado'], 404);
     }

     $tratamiento->delete();

     return response()->json(['message' => 'tratamiento eliminado'], 200);
 }

}
 //


