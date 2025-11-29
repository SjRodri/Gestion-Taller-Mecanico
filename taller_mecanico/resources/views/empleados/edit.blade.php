@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Empleado</h2>

    <form action="{{ route('empleados.update', $empleado->empleado_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ $empleado->dni }}" required>
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $empleado->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ $empleado->apellido }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $empleado->telefono }}" required>
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <input type="text" name="rol" class="form-control" value="{{ $empleado->rol }}" required>
        </div>

        <div class="mb-3">
            <label>Taller</label>
            <select name="taller_id" class="form-control" required>
                @foreach($talleres as $t)
                <option value="{{ $t->taller_id }}"
                    {{ $empleado->taller_id == $t->taller_id ? 'selected' : '' }}>
                    {{ $t->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ $empleado->correo }}" required>
        </div>

        <div class="mb-3">
            <label>Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" value="{{ $empleado->fecha_ingreso }}" required>
        </div>

        <div class="mb-3">
            <label>Activo</label>
            <select name="activo" class="form-control" required>
                <option value="1" {{ $empleado->activo == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $empleado->activo == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>

        <a href="{{ route('empleados.index') }}" class="btn btn-secondary ms-2">
            Cerrar
        </a>

    </form>
</div>
@endsection