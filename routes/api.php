<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\parcelasController;
use App\Http\Controllers\cultivoController;


Route::get('/explotaciones2', [ExplotacionController::class, 'index2']);
Route::get('/', [ExplotacionController::class, 'index']);


Route::get('/parcelas',[parcelasController::class, 'index']);
Route::get('/parcelas/{id}',[parcelasController::class, 'show']);
Route::get('/parcelas/explotacion/{explotacion_id}',[parcelasController::class, 'porExplotacion']);
Route::get('/explotaciones/datos/{id}',[parcelasController::class, 'getDatosPorExplotacion']);


Route::get('/cultivos_nombre/{id}',[cultivoController::class, 'getNombre']);
Route::get('/cultivos_nombre', [CultivoController::class, 'getNombres']);


Route::get('/parcelas/explotacion/{explotacion_id}/rendimiento',[parcelasController::class, 'porExplotacion']);


