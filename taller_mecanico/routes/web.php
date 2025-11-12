<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [ClienteController::class, 'index']);

Route::get('/registro', function () {
    return view('registro');
})->name('registro');

Route::get('/login', function () {
    return view('login');
})->name('login');
