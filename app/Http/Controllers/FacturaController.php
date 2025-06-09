<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\FacturaLinea;
use App\Models\Cliente;
use App\Models\Cultivo;
use App\Models\Explotacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;


class FacturaController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return Factura::with('cliente')->orderBy('fecha','desc')->get();
        }
        $clientes = Cliente::orderBy('nombre_completo')->get();
        $explotaciones = Explotacion::orderBy('nombre')->get();
        return view('ventas.facturas', compact('clientes','explotaciones'));
    }
        public function indexJson()
    {
        $facturas = Factura::with('cliente')->with('lineas')->with('lineas.explotacion', 'lineas.cultivo')
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($facturas);
    }

    public function cambiarEstado(Request $request, $id)
    {

        $factura = Factura::findOrFail($id);
        // Validar el estado recibido

        $request->validate([
            'estado' => 'required|in:pendiente,pagada,vencida',
        ]);

        $factura->update(['estado' => $request->estado]);

        return response()->json(['message' => 'Estado actualizado correctamente.']);
        return redirect()
            ->route('facturas.index')
            ->with('success', 'Estado de la factura actualizado correctamente.');
    }



    public function create()
    {
        $clientes      = Cliente::orderBy('nombre_completo')->get();
        $cultivos      = Cultivo::orderBy('nombre')->get();
        $explotaciones = Explotacion::orderBy('nombre')->get();

        return view('facturas.create', compact('clientes', 'cultivos', 'explotaciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero'        => 'required|string|max:50|unique:facturas,numero',
            'cliente_id'    => 'required|exists:clientes,id',
            'fecha'         => 'required|date',
            'tipo_pago'     => 'required|in:efectivo,tarjeta,transferencia,cheque',
            'estado'        => 'required|in:pendiente,pagada,vencida',
            'neto'          => 'required|numeric|min:0',
            'impuestos'     => 'required|numeric|min:0',
            'total'         => 'required|numeric|min:0',
            'cultivo_id'        => 'required|array|min:1',
            'explotacion_id'    => 'required|array|min:1',
            'precio_unitario'   => 'required|array|min:1',
            'cantidad'          => 'required|array|min:1',
            'subtotal'          => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $factura = Factura::create([
                'numero'     => $validated['numero'],
                'cliente_id' => $validated['cliente_id'],
                'fecha'      => $validated['fecha'],
                'tipo_pago'  => $validated['tipo_pago'],
                'estado'     => $validated['estado'],
                'neto'       => $validated['neto'],
                'impuestos'  => $validated['impuestos'],
                'total'      => $validated['total'],
            ]);

            $lineCount = count($validated['cultivo_id']);
            for ($i = 0; $i < $lineCount; $i++) {
                FacturaLinea::create([
                    'factura_id'      => $factura->id,
                    'numero_linea'    => $i + 1,
                    'cultivo_id'      => $validated['cultivo_id'][$i],
                    'explotacion_id'  => $validated['explotacion_id'][$i],
                    'precio_unitario' => $validated['precio_unitario'][$i],
                    'cantidad'        => $validated['cantidad'][$i],
                    'subtotal'        => $validated['subtotal'][$i],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('facturas.index')
                ->with('success', 'Factura creada correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un fallo al guardar la factura.']);
        }
    }

    public function show(Factura $factura)
    {
        $factura->load([
            'cliente',
            'lineas.cultivo',
            'lineas.explotacion',
        ]);

        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        $factura->load('lineas');
        $clientes      = Cliente::orderBy('nombre_completo')->get();
        $cultivos      = Cultivo::orderBy('nombre')->get();
        $explotaciones = Explotacion::orderBy('nombre')->get();

        return view('facturas.edit', compact('factura', 'clientes', 'cultivos', 'explotaciones'));
    }

    public function update(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'numero'        => 'required|string|max:50|unique:facturas,numero,' . $factura->id,
            'cliente_id'    => 'required|exists:clientes,id',
            'fecha'         => 'required|date',
            'tipo_pago'     => 'required|in:efectivo,tarjeta,transferencia,cheque',
            'estado'        => 'required|in:pendiente,pagada,vencida',
            'neto'          => 'required|numeric|min:0',
            'impuestos'     => 'required|numeric|min:0',
            'total'         => 'required|numeric|min:0',
            'cultivo_id'        => 'required|array|min:1',
            'explotacion_id'    => 'required|array|min:1',
            'precio_unitario'   => 'required|array|min:1',
            'cantidad'          => 'required|array|min:1',
            'subtotal'          => 'required|array|min:1',
        ]);

        DB::beginTransaction();
        try {
            $factura->update([
                'numero'     => $validated['numero'],
                'cliente_id' => $validated['cliente_id'],
                'fecha'      => $validated['fecha'],
                'tipo_pago'  => $validated['tipo_pago'],
                'estado'     => $validated['estado'],
                'neto'       => $validated['neto'],
                'impuestos'  => $validated['impuestos'],
                'total'      => $validated['total'],
            ]);

            $factura->lineas()->delete();

            $lineCount = count($validated['cultivo_id']);
            for ($i = 0; $i < $lineCount; $i++) {
                FacturaLinea::create([
                    'factura_id'      => $factura->id,
                    'numero_linea'    => $i + 1,
                    'cultivo_id'      => $validated['cultivo_id'][$i],
                    'explotacion_id'  => $validated['explotacion_id'][$i],
                    'precio_unitario' => $validated['precio_unitario'][$i],
                    'cantidad'        => $validated['cantidad'][$i],
                    'subtotal'        => $validated['subtotal'][$i],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('facturas.index')
                ->with('success', 'Factura actualizada correctamente.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un fallo al actualizar la factura.']);
        }
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();

        return redirect()
            ->route('facturas.index')
            ->with('success', 'Factura eliminada correctamente.');
    }


     public function descargarPdf(Factura $factura)
    {
        // Cargar relaciones: cliente, líneas con cultivo y explotación
        $factura->load(['cliente', 'lineas.cultivo', 'lineas.explotacion']);

        // Cargar la vista Blade que formatea la factura
        $pdf = Pdf::loadView('pdf.factura', compact('factura'))
                  ->setPaper('a4', 'portrait'); // A4 vertical (puedes ajustar si lo quieres horizontal)

        // Descargar con nombre "factura-{numero}.pdf"
        return $pdf->download("factura-{$factura->numero}.pdf");
    }
}
