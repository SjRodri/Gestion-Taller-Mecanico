<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\TallerController;

/*
|--------------------------------------------------------------------------
| Página raíz → Login
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/* ---------------- LOGIN ---------------- */
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/* ---------------- REGISTRO ---------------- */
Route::get('/registro', [RegistroController::class, 'showRegistro'])->name('registro');
Route::post('/registro', [RegistroController::class, 'registrar'])->name('registrar');

/* ============================================================
   RUTAS PROTEGIDAS POR ROL
   ============================================================ */

/* ---------------- ADMIN ---------------- */
Route::middleware(['auth', 'admin'])->group(function () {

    // CLIENTES
    Route::resource('clientes', ClienteController::class);

    // EMPLEADOS
    Route::resource('empleados', EmpleadoController::class);

    // TALLERES
    Route::resource('talleres', TallerController::class);

    // REPORTES
    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');
});

/* ---------------- EMPLEADO ---------------- */
Route::middleware(['auth', 'empleado'])->group(function () {

    // REPUESTOS
    Route::get('/repuestos', function () {
        return view('repuestos.index');
    })->name('repuestos.index');
});

/* ---------------- CLIENTE ---------------- */
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::resource('ordenes', OrdenController::class)->only(['index', 'create', 'store']);
});

/* ---------------- COMPARTIDO POR TODOS LOS ROLES ---------------- */

Route::middleware(['auth'])->group(function () {
    Route::resource('ordenes', OrdenController::class);
});

// Mapa visible para todos: admin, empleado y cliente
Route::middleware('auth')->group(function () {
    Route::get('/mapa', [MapController::class, 'index'])->name('mapa.index');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

// API abierta sin auth→ solo datos del mapa
Route::get('/api/talleres', [MapController::class, 'talleresJson']);

// Compatibilidad con /home
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home');
