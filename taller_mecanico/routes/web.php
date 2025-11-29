<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RepuestoController;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de recursos principales
Route::resource('empleados', EmpleadoController::class);
Route::resource('repuestos', RepuestoController::class);
Route::resource('clientes', ClienteController::class);

// Rutas del mapa
Route::get('/mapa', [MapController::class, 'index'])->name('mapa.index');
Route::get('/api/talleres', [MapController::class, 'talleresJson']);

// Rutas de vistas simples
Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::get('/login', function () {
    return view('login');
})->name('login');

use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ReporteVentaController;

Route::resource('ordenes', OrdenController::class);

//toodas las rutas de reportes
Route::prefix('reportes-ventas')->group(function () {
    Route::get('/', [ReporteVentaController::class, 'index'])->name('reportes.index');
    Route::get('/create', [ReporteVentaController::class, 'create'])->name('reportes.create');        
    Route::post('/', [ReporteVentaController::class, 'store'])->name('reportes.store');
    Route::get('/{id}/edit', [ReporteVentaController::class, 'edit'])->name('reportes.edit');       
    Route::put('/{id}', [ReporteVentaController::class, 'update'])->name('reportes.update');
    Route::get('/{id}', [ReporteVentaController::class, 'show'])->name('reportes.show'); 
    Route::delete('/{id}', [ReporteVentaController::class, 'destroy'])->name('reportes.destroy');
});

//rutas para descargar pdf
Route::get('/reportes/export/pdf', [ReporteVentaController::class, 'exportPdf'])->name('reportes.export.pdf');


//Esto solo es una prueba que el tinker pdf funciona y si funciona al 100%
Route::get('/pdf-test', function () {
    return Pdf::loadHTML('<h1>PDF funcionando correctamente</h1>')->stream();
});
