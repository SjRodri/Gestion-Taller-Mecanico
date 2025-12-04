@extends('layouts.panel')

@section('title', 'Inicio')
@section('page-title', 'Bienvenido, ' . ucfirst(auth()->user()->rol))
@section('content')

<div class="row g-3">

    @if(auth()->user()->rol == 'admin')
    <div class="col-md-4 mb-3">
        <a href="{{ route('clientes.index') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Clientes atendidos</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Estado de órdenes</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card p-4 text-center">Ingresos Mensuales</div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card p-4 text-center">Repuestos con bajo stock</div>
    </div>

    <div class="col-md-4 mb-3">
        <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Próximas citas</div>
        </a>
    </div>

    <div class="col-md-4 mb-3">
        <a href="{{ url('/mapa') }}" class="text-decoration-none text-dark">
            <div class="card p-4 text-center hover-card">Mapa de sucursales</div>
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