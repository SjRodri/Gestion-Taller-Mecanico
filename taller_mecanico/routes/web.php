<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RepuestoController;

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

Route::resource('ordenes', OrdenController::class);
