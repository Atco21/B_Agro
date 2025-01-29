<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;

Route::get('/explotacion', [ExplotacionController::class, 'index']);
Route::get('/', [ExplotacionController::class, 'index']);
