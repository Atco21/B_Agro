<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;
use App\Models\Maquina;
use App\Models\Orden;
use App\Models\Almacen;



class ExplotacionController extends Controller
{
    public function index(Request $request)
    {
        $explotacion = Explotacion::all();
        return view('explotacion', compact('explotacion'));
    }

    public function editar(Request $request)
    {
        $explotacion = Explotacion::all();
        return view('editarExplotaciones', compact('explotacion'));
    }

    public function general()
    {
        $explotacion = Explotacion::all();

        $ordenes = Orden::all();
        $todasOrdenes = [
            'pendientes' => 0,
            'enCurso' => 0,
            'pausadas' => 0,
            'completadas' => 0,
        ];
        foreach ($ordenes as $orden) {

            switch ($orden->estado) {
                case 'Pendiente':
                    $todasOrdenes['pendientes']++;
                    break;
                case 'En curso':
                    $todasOrdenes['enCurso']++;
                    break;
                case 'Pausada':
                    $todasOrdenes['pausadas']++;
                    break;
                case 'Completada':
                    $todasOrdenes['completadas']++;
                    break;
            }
        }
        return view('explotaciones.general', compact('explotacion'), compact('todasOrdenes'));
    }

    public function incidencias(){
        $explotacion = Explotacion::all();
        return view('explotaciones.incidencias', compact('explotacion'));
    }

    public function maquinas(){
        $explotacion = Explotacion::all();
        $maquinas = Maquina::all();
        return view('explotaciones.maquinas', compact('explotacion'), compact('maquinas'));
    }

    public function almacen(){
        $explotacion = Explotacion::all();
        $almacenes =  Almacen::with(['explotacion'])->get();
        return view('explotaciones.almacen', compact('explotacion'), compact('almacenes'));
    }

    public function index2(Request $request)
    {
        $explotacion = Explotacion::all();
        return $explotacion;
    }

    public function parcelas()
    {
        $explotacion = Explotacion::all();
        return view('explotaciones.parcelas', compact('explotacion'));
    }

}
