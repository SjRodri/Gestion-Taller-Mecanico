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
});

/* ---------------- EMPLEADO ---------------- */
Route::middleware(['auth', 'empleado'])->group(function () {});

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

    // REPUESTOS
    Route::resource('repuestos', RepuestoController::class);

    // REPORTES (VISTA GENERAL)
    Route::get('/reportes', function () {
        return view('reportes.index');
    })->name('reportes.index');

    // REPORTES DE VENTAS CRUD
    Route::prefix('reportes')->group(function () {

        // LISTADO DE REPORTES
        Route::get('/', [ReporteVentaController::class, 'index'])->name('reportes.index');

        // CREAR
        Route::get('/create', [ReporteVentaController::class, 'create'])->name('reportes.create');

        // GUARDAR
        Route::post('/', [ReporteVentaController::class, 'store'])->name('reportes.store');

        // EDITAR
        Route::get('/{id}/edit', [ReporteVentaController::class, 'edit'])->name('reportes.edit');

        // ACTUALIZAR
        Route::put('/{id}', [ReporteVentaController::class, 'update'])->name('reportes.update');

        // DETALLE
        Route::get('/{id}', [ReporteVentaController::class, 'show'])->name('reportes.show');

        // ELIMINAR
        Route::delete('/{id}', [ReporteVentaController::class, 'destroy'])->name('reportes.destroy');
    });

    // Descargar PDF
    Route::get('/reportes/export/pdf', [ReporteVentaController::class, 'exportPdf'])
        ->name('reportes.export.pdf');
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
