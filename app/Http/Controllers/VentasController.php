<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\AlmacenCosecha;
use App\Models\Almacen;
use App\Models\Explotacion;



class VentasController extends Controller
{
        public function index()
    {
        return view('ventas');

    }


    public function clientes(){

        $clientes = Cliente::orderBy('nombre_completo')->get();

        return view('ventas.clientes', compact('clientes'));

    }

    public function facturas(){

        $clientes = Cliente::all();
        $cultivos = AlmacenCosecha::with('cultivo')->with('almacen')->get();
        $almacenes = Almacen::all();
        $explotaciones = Explotacion::all();

        return view('ventas.facturas', compact('clientes', 'cultivos', 'almacenes', 'explotaciones'));

    }




    public function store(Request $request)
    {
        // Validación de los campos enviados desde el formulario
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'dni_nif'         => 'required|string|max:50|unique:clientes,dni_nif',
            'direccion'       => 'nullable|string|max:255',
            'telefono'        => 'nullable|string|max:50',
            'email'           => 'nullable|email|max:100',
            'es_empresa'      => 'sometimes|boolean',
        ]);

        // Si el checkbox "es_empresa" no viene en el request, lo forzamos a false
        if (! isset($validated['es_empresa'])) {
            $validated['es_empresa'] = false;
        }

        // Crea el cliente en la base de datos
        Cliente::create($validated);

        // Redirige de vuelta al listado con mensaje de éxito (ajusta la ruta si la tienes diferente)
        return redirect()
            ->route('ventas.clientes')
            ->with('success', 'Cliente creado correctamente.');
    }


    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'dni_nif'         => 'required|string|max:50|unique:clientes,dni_nif,' . $cliente->id,
            'direccion'       => 'nullable|string|max:255',
            'telefono'        => 'nullable|string|max:50',
            'email'           => 'nullable|email|max:100',
            'es_empresa'      => 'sometimes|boolean',
        ]);

        if (! isset($validated['es_empresa'])) {
            $validated['es_empresa'] = false;
        }

        // Actualiza los datos del cliente
        $cliente->update($validated);

        return redirect()
            ->route('ventas.clientes')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified client from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()
            ->route('ventas.clientes')
            ->with('success', 'Cliente eliminado correctamente.');
    }


}
