<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\parcelasController;
use App\Http\Controllers\rendController;
use App\Http\Controllers\TrabajadorController;


Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/explotaciones', [explotacionController::class, 'index']);

// dfiobvisfn
Route::get('/trabajadores', [TrabajadorController::class, 'index']);

Route::get('/informes', function () {
    return view('informes');
});


Route::get('/explotaciones/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
Route::get('/explotaciones/parcelas', [parcelasController::class, 'listarParcelasPorExplotacion'])->name('parcelas.listar');
Route::get('/explotaciones/tareas', [ExplotacionController::class, 'tareas'])->name('explotaciones.tareas');
Route::get('/explotaciones/incidencias', [ExplotacionController::class, 'incidencias'])->name('explotaciones.inciendias');
Route::get('/explotaciones/maquinas', [ExplotacionController::class, 'maquinas'])->name('explotaciones.maquinas');
Route::get('/explotaciones/pedidos', [explotacionController::class, 'pedidos'])->name('explotaciones.pedidos');
Route::get('/parcelas',[parcelasController::class, 'porExplotacion']);
Route::get('/explotaciones/parcelas/{id}',[parcelasController::class, 'listarParcelasPorExplotacion']);


Route::get('/explotaciones/parcelas/{idExplotacion}/{idParcela}/rendimiento', [rendController::class, 'index' ]);
