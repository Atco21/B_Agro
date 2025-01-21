<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
<<<<<<< HEAD
    return view('layouts.app');
=======
    return view('home');
>>>>>>> f896ce377dbf9a65135c425bd458e3e8e636df29
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