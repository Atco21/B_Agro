<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/explotaciones', function () {
    return view('explotaciones');
});

Route::get('/trabajadores', function () {
    return view('trabajadores');
});

Route::get('/informes', function () {
    return view('informes');
});