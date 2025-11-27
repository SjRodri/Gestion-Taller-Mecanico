@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Taller</h2>

    <form action="{{ route('talleres.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Horario</label>
            <input type="text" name="horario" class="form-control">
        </div>

        <div class="mb-3">
            <label>Latitud</label>
            <input type="text" name="latitude" class="form-control">
        </div>

        <div class="mb-3">
            <label>Longitud</label>
            <input type="text" name="longitude" class="form-control">
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('talleres.index') }}" class="btn btn-secondary ms-2">Cerrar</a>

    </form>
</div>
@endsection
