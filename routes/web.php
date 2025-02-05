<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;


Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/explotaciones', [explotacionController::class, 'index']);


Route::get('/trabajadores', function () {
    return view('trabajadores');
});

Route::get('/informes', function () {
    return view('informes');
});


Route::get('/explotaciones/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
Route::get('/explotaciones/parcelas', [ExplotacionController::class, 'parcelas'])->name('explotaciones.parcelas');
Route::get('/explotaciones/tareas', [ExplotacionController::class, 'tareas'])->name('explotaciones.tareas');
Route::get('/explotaciones/incidencias', [ExplotacionController::class, 'incidencias'])->name('explotaciones.inciendias');
Route::get('/explotaciones/maquinas', [ExplotacionController::class, 'maquinas'])->name('explotaciones.maquinas');


