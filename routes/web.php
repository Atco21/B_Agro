<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\parcelasController;
use App\Http\Controllers\rendController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\MaquinaController;


Route::get('/', function(){
    return view('layouts.login');
});


Route::get('/home', function () {
    return view('layouts.app');
});

//middle
Route::get('/explotaciones', [explotacionController::class, 'index'])->name('explotaciones');

//
Route::get('/trabajadores', [TrabajadorController::class, 'index'])->name('trabajadores');


Route::get('/informes', function () {
    return view('informes');
});


Route::get('/explotaciones/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
Route::get('/explotaciones/parcelas', [parcelasController::class, 'listarParcelasPorExplotacion'])->name('parcelas.listar');
Route::get('/explotaciones/ordenes', [ExplotacionController::class, 'ordenes'])->name('explotaciones.ordenes');
Route::get('/explotaciones/incidencias', [ExplotacionController::class, 'incidencias'])->name('explotaciones.inciendias');
Route::get('/explotaciones/maquinas', [ExplotacionController::class, 'maquinas'])->name('explotaciones.maquinas');

Route::get('/explotaciones/pedidos', [explotacionController::class, 'pedidos'])->name('explotaciones.pedidos');


Route::get('/explotaciones/parcelas/{id}',[parcelasController::class, 'listarMaquinasPorExplotacion']);




Route::get('/explotaciones/parcelas/{idExplotacion}/{idParcela}/rendimiento', [rendController::class, 'index' ]);

Route::get('/maquinas', [MaquinaController::class, 'index'])->name('maquinas');
Route::post('/maquinas', [MaquinaController::class, 'store'])->name('maquinas.store');


Route::get('/explotaciones/maquinas/{id}', [MaquinaController::class, 'mostrarMaquinasPorExplotacion']);
Route::get('/explotaciones/maquinas/{id}', [MaquinaController::class, 'listarParcelasPorExplotacion']);
