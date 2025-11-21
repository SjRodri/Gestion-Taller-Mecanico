<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clientes', ClienteController::class);
Route::resource('empleados', EmpleadoController::class);
Route::get('/mapa', [MapController::class, 'index'])->name('mapa.index');
Route::get('/api/talleres', function () {
    return \App\Models\Taller::all();
});
Route::get('/mapa', [MapController::class, 'index']);
Route::get('/api/talleres', [MapController::class, 'talleresJson']);


Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::get('/login', function () {
    return view('login');
})->name('login');
