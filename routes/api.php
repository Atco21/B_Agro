<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;
use App\Http\Controllers\TratamientoController;//esto te lleva al controlador de tratamientos


Route::get('/explotaciones2', [ExplotacionController::class, 'index2']);
Route::get('/', [ExplotacionController::class, 'index']);
Route::get('/tratamiento', [TratamientoController::class, 'mostrarTratamientos']);//esto te lleva al controlador de tratamientos