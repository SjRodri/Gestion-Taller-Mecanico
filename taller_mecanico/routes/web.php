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

use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\ReporteVentaController;
use Barryvdh\DomPDF\Facade\Pdf;

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

    // REPORTES (VISTA GENERAL)
    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');

    // REPORTES DE VENTAS CRUD
    Route::prefix('reportes-ventas')->group(function () {
        Route::get('/', [ReporteVentaController::class, 'index'])->name('reportes.ventas.index');
        Route::get('/create', [ReporteVentaController::class, 'create'])->name('reportes.ventas.create');
        Route::post('/', [ReporteVentaController::class, 'store'])->name('reportes.ventas.store');
        Route::get('/{id}/edit', [ReporteVentaController::class, 'edit'])->name('reportes.ventas.edit');
        Route::put('/{id}', [ReporteVentaController::class, 'update'])->name('reportes.ventas.update');
        Route::get('/{id}', [ReporteVentaController::class, 'show'])->name('reportes.ventas.show');
        Route::delete('/{id}', [ReporteVentaController::class, 'destroy'])->name('reportes.ventas.destroy');
    });

    // Exportar PDF
    Route::get('/reportes/export/pdf', [ReporteVentaController::class, 'exportPdf'])
        ->name('reportes.export.pdf');
});

/* ---------------- EMPLEADO ---------------- */
Route::middleware(['auth', 'empleado'])->group(function () {

    // REPUESTOS
    Route::resource('repuestos', RepuestoController::class);
});

/* ---------------- CLIENTE ---------------- */
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::resource('ordenes', OrdenController::class)->only(['index', 'create', 'store']);
});

/* ---------------- COMPARTIDO POR TODOS LOS ROLES ---------------- */

Route::middleware(['auth'])->group(function () {

    // Ordenes completas
    Route::resource('ordenes', OrdenController::class);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Mapa
    Route::get('/mapa', [MapController::class, 'index'])->name('mapa.index');
});

// API pública para el mapa
Route::get('/api/talleres', [MapController::class, 'talleresJson']);

// Compatibilidad con /home
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth')->name('home');

// Test PDF
Route::get('/pdf-test', function () {
    return Pdf::loadHTML('<h1>PDF funcionando correctamente</h1>')->stream();
});
