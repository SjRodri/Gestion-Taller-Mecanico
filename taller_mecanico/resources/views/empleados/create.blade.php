@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Empleado</h2>

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <input type="text" name="rol" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Taller</label>
            <select name="taller_id" class="form-control" required>
                <option value="">Seleccione un taller</option>
                @foreach($talleres as $t)
                    <option value="{{ $t->taller_id }}">{{ $t->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Activo</label>
            <select name="activo" class="form-control" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary">Guardar</button>

        <a href="{{ route('empleados.index') }}" class="btn btn-secondary ms-2">
            Cerrar
        </a>

    </form>
</div>
@endsection
