<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;


Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/explotacion', [explotacionController::class, 'index']);


Route::get('/trabajadores', function () {
    return view('trabajadores');
});

Route::get('/informes', function () {
    return view('informes');
});


Route::get('/explotacion/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
