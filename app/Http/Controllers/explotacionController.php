<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explotacion;

class explotacionController extends Controller
{
    public function index(Request $request)
    {
        $explotacion = Explotacion::all();
        // $explotacion = [];
        return view('explotaciones', ['explotacion' => $explotacion]);
    } 
}
