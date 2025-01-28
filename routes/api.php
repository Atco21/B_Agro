<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;

Route::get('/explotaciones', [ExplotacionController::class, 'index']); 
Route::get('/', [ExplotacionController::class, 'index']); 
