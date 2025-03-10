<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\parcelasController;
use App\Http\Controllers\aplicadoresController;
use App\Http\Controllers\quimicosController;
use App\Http\Controllers\almacenesController;
use App\Http\Controllers\AuthLController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\TratamientoController;


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/loginAngular', [AuthController::class, 'loginAngular'])->name('loginAngular');

Route::get('/explotaciones2', [ExplotacionController::class, 'index2']);
// Route::get('/', [ExplotacionController::class, 'index']);


Route::get('/parcelas', [parcelasController::class, 'index']);
Route::get('/parcelas/{id}', [parcelasController::class, 'show']);
Route::get('/parcelas/explotacion/{explotacion_id}', [parcelasController::class, 'porExplotacion']);
Route::get('/aplicador1', [aplicadoresController::class, 'index']);
Route::get('/quimicos', [quimicosController::class, 'mostrarQuimicos']);
Route::get('/quimicos/pedidos', [quimicosController::class, 'hacerPedido']);
Route::get('/almacenes', [almacenesController::class, 'index']);
Route::get('/almacenes/{id}', [almacenesController::class, 'show']);
Route::get('/almacenes/explotacion/{explotacion_id}', [almacenesController::class, 'porExplotacion']);
Route::get('/almacenes/parcela/{parcela_id}', [almacenesController::class, 'porParcela']);
Route::get('/almacenes/quimico/{quimico_id}', [almacenesController::class, 'porQuimico']);



Route::post('/ordenes', [OrdenController::class, 'store']);
Route::get('/ordenesPendientes', [OrdenController::class, 'ordenesPendientes'])->name('ordenesPendientes');
Route::get('/ordenesCurso', [OrdenController::class, 'ordenesCurso'])->name('ordenesCurso');
Route::get('/ordenesPausadas', [OrdenController::class, 'ordenesPausa'])->name('ordenesPausa');
Route::get('/ordenesTerminadas', [OrdenController::class, 'ordenesTerminadas'])->name('ordenesTerminadas');




