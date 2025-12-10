@extends('layouts.panel')

@section('title', 'Inicio')
@section('page-title', 'Bienvenido, ' . ucfirst(auth()->user()->rol))

@section('content')

<div class="row g-3">

    {{-- ADMIN --}}
    @if(auth()->user()->rol == 'admin')

        <div class="col-md-4 mb-3">
            <a href="/clientes/create" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-user-plus icon-red"></i>
                    Agregar Clientes
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/empleados/create" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-user-tie icon-red"></i>
                    Agregar Empleados
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=finalizada" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-check icon-red"></i>
                    Órdenes finalizadas
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/repuestos?filter=bajo_stock" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-boxes-stacked icon-red"></i>
                    Repuestos con bajo stock
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/repuestos?filter=sin_stock" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-circle-xmark icon-red"></i>
                    Repuestos sin stock
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=espera" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-calendar-check icon-red"></i>
                    Próximas citas
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/talleres/create" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-location-dot icon-red"></i>
                    Agregar sucursal al mapa
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/reportes/create" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-file-circle-plus icon-red"></i>
                    Crear reporte
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/reportes/export/pdf" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-file-arrow-down icon-red"></i>
                    Descargar último reporte de ventas
                </div>
            </a>
        </div>

    @endif



    {{-- EMPLEADO --}}
    @if(auth()->user()->rol == 'empleado')

        <div class="col-md-4 mb-3">
            <div class="card p-4 text-center hover-card">
                <i class="fa-solid fa-boxes-stacked icon-red"></i>
                Repuestos con bajo stock
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=finalizada" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-check icon-red"></i>
                    Órdenes finalizadas
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="/ordenes?buscar=&taller_id=&vehiculo_id=&fecha=&estado=Activa" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-calendar-check icon-red"></i>
                    Próximas citas
                </div>
            </a>
        </div>

    @endif



    {{-- CLIENTE --}}
    @if(auth()->user()->rol == 'cliente')

        <div class="col-md-4 mb-3">
            <a href="{{ route('ordenes.create') }}" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-calendar-plus icon-red"></i>
                    Programar cita
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-list-check icon-red"></i>
                    Mis citas
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="{{ url('/mapa') }}" class="text-decoration-none text-dark">
                <div class="card p-4 text-center hover-card">
                    <i class="fa-solid fa-map-location-dot icon-red"></i>
                    Mapa de talleres
                </div>
            </a>
        </div>

    @endif

</div>

@endsection



@push('styles')
<style>
    .hover-card {
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    /*.icon-red {
        font-size: 30px;
        color: #9A0D1B;
        margin-bottom: 10px;
    }*/ /*NO FUNCIONO*/
</style>
@endpush

