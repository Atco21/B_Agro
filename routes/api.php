<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\parcelasController;
use App\Http\Controllers\cultivoController;
use App\Http\Controllers\rendController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\AuthController;

// Users
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('register', [TrabajadorController::class,'register']);
Route::post('/trabajadores', [TrabajadorController::class, 'register'])->name('register');

Route::post('/crear_orden' ,[OrdenesController::class, 'crearOrden']);

Route::get('/aplicadores', [TrabajadorController::class, 'aplicadores'])->name('aplicadores');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('details', [TrabajadorController::class,'details']);
    Route::get('logout', [TrabajadorController::class,'logout']);
});




//explotaciones y parcelas
Route::get('/explotaciones2', [ExplotacionController::class, 'index2']);
Route::get('/', [ExplotacionController::class, 'index']);


Route::get('/parcelas',[parcelasController::class, 'index']);
Route::get('/parcelas/{id}',[parcelasController::class, 'show']);
Route::get('/parcelas/explotacion/{explotacion_id}',[parcelasController::class, 'porExplotacion']);
Route::get('/explotaciones/datos/{id}',[parcelasController::class, 'getDatosPorExplotacion']);


//cultivos
Route::get('/cultivos_nombre/{id}',[cultivoController::class, 'getNombre']);
Route::get('/cultivos_nombre', [CultivoController::class, 'getNombres']);


Route::get('/parcelas/explotacion/{explotacion_id}/rendimiento',[parcelasController::class, 'porExplotacion']);


Route::get('/rendimiento/{id}',[rendController::class, 'mostrarParcela']);

Route::get('/tratamiento', [TratamientoController::class, 'mostrarTratamientos']);//esto te lleva al controlador de tratamientos

//


Route::get('/maquinas/explotacion/{id}', [MaquinaController::class, 'mostrarMaquinasPorExplotacion']);





//Route::get('/ordenes/explotacion/{id}', OrdenesController::class, 'mostrarOrdenesPorExplotacion');
