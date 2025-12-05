<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\EmpleadoController;
use App\Models\Vehiculo;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('vehiculos', VehiculoController::class);
