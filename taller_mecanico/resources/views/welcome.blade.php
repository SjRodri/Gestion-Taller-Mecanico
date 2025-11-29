@extends('layouts.app')

@section('title', 'Inicio')
@section('page-title', 'Bienvenido, ' . ucfirst(auth()->user()->rol))

@section('content')

@if(auth()->user()->rol == 'admin')
<div class="col-md-4 mb-3">
    <a href="{{ route('clientes.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Clientes atendidos</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Estado de órdenes</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('ingresos.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Ingresos Mensuales</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('repuestos.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Repuestos con bajo stock</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('ordenes.create') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Próximas citas</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="/mapa" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Mapa de sucursales</div>
    </a>
</div>
@endif

@if(auth()->user()->rol == 'empleado')
<div class="col-md-4 mb-3">
    <a href="{{ route('repuestos.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Repuestos con bajo stock</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Órdenes finalizadas</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Próximas citas</div>
    </a>
</div>
@endif

@if(auth()->user()->rol == 'cliente')
<div class="col-md-4 mb-3">
    <a href="{{ route('ordenes.create') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Programar cita</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="{{ route('ordenes.index') }}" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Mis citas</div>
    </a>
</div>

<div class="col-md-4 mb-3">
    <a href="/mapa" class="text-decoration-none text-dark">
        <div class="card p-4 text-center">Mapa de talleres</div>
    </a>
</div>
@endif

</div>

@endsection