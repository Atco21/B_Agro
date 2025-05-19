<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ExplotacionController;
use App\Http\Controllers\ParcelasController;
use App\Http\Controllers\rendController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PDFController;


Route::get('/', function(){
    return view('layouts.login');
});

Route::post('login', [AuthController::class, 'login'])->name('login');



Route::get('/home', function () {
    return view('layouts.app');
});




//middle
//Route::get('/admin/explotaciones', [Explotacioncontroller::class, 'index'])->name('explotaciones')->middleware('admin');



Route::group(['middleware' => 'admin'], function(){


    Route::get('/explotaciones/editar', [Explotacioncontroller::class, 'editar'])->name('explotaciones');

    Route::get('/trabajadores', [TrabajadorController::class, 'index'])->name('trabajadores');

    Route::put('/trabajadores', [TrabajadorController::class, 'update'])->name('trabajadores.update');



    Route::get('/informes', function () {
        return view('informes');
    });

    Route::get('/explotaciones/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
    Route::get('/explotaciones/parcelas', [ParcelasController::class, 'listarParcelasPorExplotacion'])->name('parcelas.listar');
    Route::get('/explotaciones/ordenes', [OrdenController::class, 'index'])->name('explotaciones.ordenes');
    Route::get('/explotaciones/incidencias', [ExplotacionController::class, 'incidencias'])->name('explotaciones.inciendias');



    Route::get('/explotaciones/almacen', [explotacionController::class, 'pedidos'])->name('explotaciones.pedidos');


    Route::get('/explotaciones/parcelas/{id}',[ParcelasController::class, 'listarParcelasPorExplotacion']);




    Route::get('/explotaciones/parcelas/{idExplotacion}/{idParcela}/rendimiento', [rendController::class, 'index' ]);

    Route::get('/explotaciones/maquinas', [ExplotacionController::class, 'maquinas'])->name('explotaciones.maquinas');
    Route::post('/maquinas', [MaquinaController::class, 'store'])->name('maquinas.store');

    Route::get('/explotaciones/ordenes/{id?}', [OrdenController::class, 'index'])->name('explotaciones.ordenes');


    // return view('explotacion', compact('explotacion'));

    // dump(Auth::check());
    Route::put('/maquinas', [MaquinaController::class, 'update'])->name('maquinas.update');

});





Route::get('pdf', [OrdenController::class, 'generarPdf'])->name('ordenes.generar.pdf');




