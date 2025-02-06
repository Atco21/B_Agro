<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcela;
use App\Models\Explotacion;
use App\Models\Rendimiento;


class rendController extends Controller
{
    public function index(){

        $explotacion = Explotacion::all();
        $parcelas = Parcelas::all();
        $rendimiento = Rendimiento::all();

        return view('explotaciones.parcela.rendimiento', compact('explotacion'), compact('parcelas'), compact('rendimiento'));


    }
}
