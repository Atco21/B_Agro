<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Almacen;
use App\Models\Quimico;
use App\Models\AlmacenQuimico;
use App\Models\AlmacenCosecha;

class AlmacenController extends Controller
{
    public function quimicos($id){

        $productosQuimicos = AlmacenQuimico::where('almacen_id', $id)->with('quimico')->get();

        return response()->json($productosQuimicos, 200);

    }

    public function cosecha($id){

        $cosecha = AlmacenCosecha::where('almacen_id', $id)->with('cultivo')->get();

        return response()->json($cosecha, 200);


    }



    public function almacenExplotacion($id){

        $almacen = Almacen::where('explotacion_id', $id)->get();

        return response()->json($almacen);
    }


    public function quimicosPeligro($id)
    {
        $almacen = Almacen::find($id);
        if (!$almacen) {
            return response()->json(['error' => 'Almacén no encontrado'], 404);
        }

        $quimicosPeligro = AlmacenQuimico::where('almacen_id', $id)
            ->whereColumn('stock', '<', 'stock_minimo')
            ->with('quimico')
            ->get();

        return response()->json($quimicosPeligro);
    }

    public function updateQuimico(Request $request)
{
    $validated = $request->validate([
        'quimico_id' => 'required|exists:almacen_quimico,id',
        'cantidad' => 'required|numeric|min:1',
    ]);

    $quimicoEnAlmacen = AlmacenQuimico::findOrFail($validated['quimico_id']);

    $quimicoEnAlmacen->stock += $validated['cantidad'];
    $quimicoEnAlmacen->save();

    return redirect()->back()->with('success', 'Stock actualizado correctamente.');
}




}
