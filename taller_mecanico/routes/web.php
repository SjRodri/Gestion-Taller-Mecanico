<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcomes');
// });



Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\ClienteController;

Route::resource('empleados', EmpleadoController::class);
Route::resource('repuestos', RepuestoController::class);
Route::resource('clientes', ClienteController::class);