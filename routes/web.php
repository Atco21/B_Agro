<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\explotacionController;
Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/explotaciones', [explotacionController::class, 'index']);


Route::get('/trabajadores', function () {
    return view('trabajadores');
});

Route::get('/informes', function () {
    return view('informes');
});