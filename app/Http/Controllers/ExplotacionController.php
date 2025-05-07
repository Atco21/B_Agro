<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;
use App\Models\Maquina;
use App\Models\Orden;


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
                case 'pendiente':
                    $todasOrdenes['pendientes']++;
                    break;
                case 'en curso':
                    $todasOrdenes['enCurso']++;
                    break;
                case 'pausada':
                    $todasOrdenes['pausadas']++;
                    break;
                case 'completada':
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

    public function pedidos(){
        $explotacion = Explotacion::all();
        return view('explotaciones.pedidos', compact('explotacion'));
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
