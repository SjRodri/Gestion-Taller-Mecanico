@extends('layouts.panel')

@section('title', 'Inicio')
@section('page-title', 'Bienvenido, ' . ucfirst(auth()->user()->rol))
@section('content')

<div class="row g-3">

    @if(auth()->user()->rol == 'admin')
    <div class="col-md-4 mb-3">
        <a href="/clientes/create" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Agregar Clientes</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/empleados/create" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Agregar Empleados</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=finalizada" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Ordenes finalizadas</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/repuestos?filter=bajo_stock" class="text-decoration-none text-dark">
            <div class="card p-4 text-center">Repuestos con bajo stock</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/repuestos?filter=sin_stock" class="text-decoration-none text-dark">
            <div class="card p-4 text-center">Repuestos sin stock</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=espera" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Próximas citas</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/talleres/create" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Agregar sucursal al mapa</div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="/reportes/create" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Crear reporte</div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="/reportes/export/pdf" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Descargar ultimo reporte de ventas</div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="http://127.0.0.1:8000/manuales/manual_administrador.pdf" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Ver Manual Admin</div>
        </a>
    </div>
    @endif

    @if(auth()->user()->rol == 'empleado')
    <div class="col-md-4 mb-3">
        <div class="card p-4 text-center">Repuestos con bajo stock</div>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=finalizada" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Órdenes finalizadas</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=Activa" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Próximas citas</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/repuestos?filter=bajo_stock" class="text-decoration-none text-dark">
            <div class="card p-4 text-center">Repuestos con bajo stock</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/repuestos?filter=sin_stock" class="text-decoration-none text-dark">
            <div class="card p-4 text-center">Repuestos sin stock</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="/vehiculos/create" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Registrar Vehiculo</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="http://127.0.0.1:8000/manuales/manual_empleados.pdf" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Ver Manual Empleado</div>
        </a>
    </div>
    @endif

    @if(auth()->user()->rol == 'cliente')
    <div class="col-md-4 mb-3">
        <a href="{{ route('ordenes.create') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Programar cita</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Mis citas</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="{{ url('/mapa') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Mapa de talleres</div>
        </a>
    </div>
    <div class="col-md-4 mb-3">
        <a href="http://127.0.0.1:8000/manuales/manual_clientes.pdf" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Ver Manual Cliente</div>
        </a>
    </div>
    @endif

</div>

{{-- Pequeño estilo local para efecto hover (si no lo tiene en su CSS global) --}}
@push('styles')
<style>
    .hover-card {
        transition: transform .15s ease, box-shadow .15s ease;
    }

    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }
</style>
@endpush

@endsection