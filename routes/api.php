<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExplotacionController;
use App\Http\Controllers\ParcelasController;
use App\Http\Controllers\cultivoController;
use App\Http\Controllers\rendController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\AlmacenController;



// Users

Route::post('register', [TrabajadorController::class,'register']);
Route::post('/trabajadores', [TrabajadorController::class, 'register'])->name('register');
Route::get('/trabajadores/{id}', [TrabajadorController::class,'filtroPorExplotacion'])->name('filtroPorExplotacion');
Route::get('/trabajadores/buscar/{id}', [TrabajadorController::class, 'buscarPorId'])->name('buscarPorId');

Route::post('/ordenes', [OrdenController::class, 'store']);
Route::get('/aplicadores', [TrabajadorController::class, 'aplicadores'])->name('aplicadores');
Route::get('ordenes/explotacion/{id}', [OrdenController::class, 'mostrarOrdenesPorExplotacion'])->name('filtroOrdenesPorExplotacion');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('details', [TrabajadorController::class,'details']);
    Route::get('logout', [TrabajadorController::class,'logout']);
});

Route::post('loginAngular', [AuthController::class, 'loginAngular'])->name('loginAngular');

//explotaciones y parcelas
Route::get('/explotaciones2', [ExplotacionController::class, 'index2']);
Route::get('/', [ExplotacionController::class, 'index']);

Route::get('/parcelas',[ParcelasController::class, 'index']);
Route::get('/parcelas/{id}',[ParcelasController::class, 'show']);
Route::get('/parcelas/explotacion/{explotacion_id}',[ParcelasController::class, 'porExplotacion']);
Route::get('/explotaciones/datos/{id}',[ParcelasController::class, 'getDatosPorExplotacion']);


Route::get('/parcelas/explotacion/{explotacion_id}/rendimiento',[ParcelasController::class, 'porExplotacion']);

Route::get('/rendimiento/{id}',[rendController::class, 'mostrarParcela']);

Route::get('/tratamiento', [TratamientoController::class, 'mostrarTratamientos']);//esto te lleva al controlador de tratamientos

//

Route::get('/maquinas/explotacion/{id}', [MaquinaController::class, 'mostrarMaquinasPorExplotacion']);

Route::get('/maquinas', [MaquinaController::class, 'index']);

Route::get('/maquinas/buscar/{id}', [MaquinaController::class, 'buscarPorId'])->name('maquinas.buscarPorId');


Route::post('/ordenes', [OrdenController::class, 'store']);

Route::get('/ordenesPendientes', [OrdenController::class, 'ordenesPendientes'])->name('ordenesPendientes');

Route::get('/ordenesCurso', [OrdenController::class, 'ordenesCurso'])->name('ordenesCurso');

Route::get('/ordenesPausadas', [OrdenController::class, 'ordenesPausa'])->name('ordenesPausa');

Route::get('/orden/{id}',  [OrdenController::class, 'show'])->name('ordenById');



Route::get('/ordenesTerminadas', [OrdenController::class, 'ordenesTerminadas'])->name('ordenesTerminadas');


Route::get('/orden/{id}', [OrdenController::class, 'ordenById'])->name('ordenById');



Route::get('/almacen/quimicos/{id}', [AlmacenController::class, 'quimicos'])->name('almacen');
Route::get('/almacen/cosecha/{id}', [AlmacenController::class, 'cosecha'])->name('almacen');


Route::get('/almacen/explotacion/{id}', [AlmacenController::class, 'almacenExplotacion'])->name('almacenExplotacion');

//Route::get('/ordenes/explotacion/{id}', OrdenesController::class, 'mostrarOrdenesPorExplotacion');

Route::get('/almacen/explotacion/quimicosPeligro/{id}', [AlmacenController::class, 'quimicosPeligro'])->name('quimicoPeligro');




Route::get('/incidenciasPersonal', [IncidenciaController::class, 'incidenciasPersonal']);
Route::get('/incidenciasMaquina', [IncidenciaController::class, 'incidenciasMaquina']);
Route::get('/incidenciasStock', [IncidenciaController::class, 'incidenciasStock']);

Route::get('/incidencias/explotacion/${id}', [IncidenciaController::class, 'incidenciaPorExplotacion'])->name('incidenciaPorExplotacion');

Route::get('aplicador/{id}', [TrabajadorController::class, 'buscarPorId']);
