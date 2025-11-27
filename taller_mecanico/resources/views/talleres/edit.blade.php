@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Taller</h2>

    <form action="{{ route('talleres.update', $taller->taller_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $taller->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ $taller->ubicacion }}">
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $taller->telefono }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $taller->email }}">
        </div>

        <div class="mb-3">
            <label>Horario</label>
            <input type="text" name="horario" class="form-control" value="{{ $taller->horario }}">
        </div>

        <div class="mb-3">
            <label>Latitud</label>
            <input type="text" name="latitude" class="form-control" value="{{ $taller->latitude }}">
        </div>

        <div class="mb-3">
            <label>Longitud</label>
            <input type="text" name="longitude" class="form-control" value="{{ $taller->longitude }}">
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('talleres.index') }}" class="btn btn-secondary ms-2">Cerrar</a>

    </form>
</div>
@endsection
