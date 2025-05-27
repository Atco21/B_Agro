<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\AlmacenCosecha;
use App\Models\Almacen;


class VentasController extends Controller
{
        public function index()
    {
        return view('ventas');

    }


    public function clientes(){

        $clientes = Cliente::all();

        return view('ventas.clientes', compact('clientes'));

    }

    public function facturas(){

        $clientes = Cliente::all();
        $cultivos = AlmacenCosecha::with('cultivo')->with('almacen')->get();
        $almacenes = Almacen::all();

        return view('ventas.facturas', compact('clientes', 'cultivos', 'almacenes'));

    }
}
