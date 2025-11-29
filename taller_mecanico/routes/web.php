<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Página raíz → Login
|--------------------------------------------------------------------------
|
| Cuando el usuario entra a http://127.0.0.1:8000 debe ver el login. 
| Aquí redirigimos a la ruta login (controlador).
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// ---------------- LOGIN ----------------
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ---------------- REGISTRO ----------------
Route::get('/registro', [RegistroController::class, 'showRegistro'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrar'])->name('registrar');

// ---------------- CRUD ----------------
Route::resource('clientes', ClienteController::class)->middleware('auth');
Route::resource('empleados', EmpleadoController::class)->middleware('auth');

// ---------------- MAPA ----------------
Route::get('/mapa', [MapController::class, 'index'])->middleware('auth')->name('mapa.index');
Route::get('/api/talleres', [MapController::class, 'talleresJson']);

// ---------------- DASHBOARD ----------------
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

// Ruta opcional por si algo lo usa
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home');
