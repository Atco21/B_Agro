<?php

use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index()
    {
        return Orden::all(); // Retorna todas las órdenes
    }

    public function store(Request $request)
    {
        $orden = Orden::create($request->all());
        return response()->json($orden, 201);
    }

    public function show($id)
    {
        return Orden::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);
        $orden->update($request->all());
        return response()->json($orden, 200);
    }

    public function destroy($id)
    {
        Orden::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

