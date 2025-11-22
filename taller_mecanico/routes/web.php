<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de Configuración usando resource
Route::resource('configuracion', ConfiguracionController::class)->parameters([
    'configuracion' => 'id' // El {id} se pasará a los métodos edit, update y destroy
]);

// Rutas de Clientes
Route::resource('clientes', ClienteController::class);
