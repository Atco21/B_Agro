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
use App\Http\Controllers\VentasController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Models\Explotacion;
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
    Route::delete('/trabajadores/{id}', [TrabajadorController::class, 'destroy'])
     ->name('trabajadores.destroy');



    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas');

    Route::get('/informes', function () {
        $explotaciones = Explotacion::all();
        return view('informes', compact('explotaciones'));
    });

    Route::get('/explotaciones/general', [ExplotacionController::class, 'general'])->name('explotaciones.general');
    Route::get('/explotaciones/parcelas', [ParcelasController::class, 'listarParcelasPorExplotacion'])->name('parcelas.listar');
    Route::get('/explotaciones/ordenes', [OrdenController::class, 'index'])->name('explotaciones.ordenes');
    Route::get('/explotaciones/incidencias', [ExplotacionController::class, 'incidencias'])->name('explotaciones.inciendias');



    Route::get('/explotaciones/almacen', [explotacionController::class, 'almacen'])->name('explotaciones.almacen');
    Route::get('/explotaciones/almacen/{id}', function () {
        return redirect('/explotaciones/almacen');
    });


    Route::get('/explotaciones/parcelas/{id}',[ParcelasController::class, 'listarParcelasPorExplotacion']);




    Route::get('/explotaciones/parcelas/{idExplotacion}/{idParcela}/rendimiento', [rendController::class, 'index' ]);

    Route::get('/explotaciones/maquinas', [ExplotacionController::class, 'maquinas'])->name('explotaciones.maquinas');
    Route::post('/maquinas', [MaquinaController::class, 'store'])->name('maquinas.store');

    Route::get('/explotaciones/ordenes/{id?}', [OrdenController::class, 'index'])->name('explotaciones.ordenes');


    // return view('explotacion', compact('explotacion'));

    // dump(Auth::check());
    Route::put('/maquinas', [MaquinaController::class, 'update'])->name('maquinas.update');

    Route::put('/almacen/quimico', [AlmacenController::class, 'updateQuimico'])->name('almacen.quimico.update');



    Route::get('/ventas/pedidos', [VentasController::class, 'facturas'])->name('ventas.facturas');
    Route::get('/ventas/clientes', [VentasController::class, 'clientes'])->name('ventas.clientes');

    Route::resource('clientes', VentasController::class);


    Route::resource('facturas', FacturaController::class);

    





    Route::get('facturas/{factura}/pdf', [FacturaController::class, 'descargarPdf'])
        ->name('facturas.pdf');
});





Route::get('pdf', [OrdenController::class, 'generarPdf'])->name('ordenes.generar.pdf');



