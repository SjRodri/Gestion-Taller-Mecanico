@extends('layouts.app')

@section('page-title', 'Editar Empleado')

@section('content')
<div class="container">
    <h2>Editar Empleado</h2>

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni', $empleado->dni) }}">
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required value="{{ old('nombre', $empleado->nombre) }}">
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required value="{{ old('apellido', $empleado->apellido) }}">
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $empleado->telefono) }}">
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <input type="text" name="rol" class="form-control" value="{{ old('rol', $empleado->rol) }}">
        </div>

        <div class="mb-3">
            <label>Taller ID</label>
            <input type="number" name="taller_id" class="form-control" value="{{ old('taller_id', $empleado->taller_id) }}">
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $empleado->correo) }}">
        </div>

        <div class="mb-3">
            <label>Fecha Ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control"
                value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}">
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection