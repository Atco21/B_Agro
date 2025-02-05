<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\parcelasController;


Route::get('/', function () {
    return view('layouts.app');
});

// <<<<<<< HEAD
// // Route::get('/prueba', function () {
// //     return view('prueba');
// // });

// =======
Route::get('/explotaciones', [explotacionController::class, 'index']);


Route::get('/trabajadores', function () {
    return view('trabajadores');
});

Route::get('/informes', function () {
    return view('informes');
});


Route::get('/explotaciones/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
Route::get('/explotaciones/parcelas', [parcelasController::class, 'listarParcelasPorExplotacion'])->name('parcelas.listar');
Route::get('/explotaciones/tareas', [ExplotacionController::class, 'tareas'])->name('explotaciones.tareas');
Route::get('/explotaciones/incidencias', [ExplotacionController::class, 'incidencias'])->name('explotaciones.inciendias');
Route::get('/explotaciones/maquinas', [ExplotacionController::class, 'maquinas'])->name('explotaciones.maquinas');
Route::get('/parcelas',[parcelasController::class, 'porExplotacion']);
// >>>>>>> 986337cc360e298b3ea64011ea364a83d9b2d772
