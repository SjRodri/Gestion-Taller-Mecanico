<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clientes', ClienteController::class);
