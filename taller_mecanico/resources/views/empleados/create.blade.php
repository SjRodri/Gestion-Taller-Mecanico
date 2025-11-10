@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nuevo Empleado</h2>

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control">
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
            <input type="text" name="telefono" class="form-control">
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <input type="text" name="rol" class="form-control">
        </div>

        <div class="mb-3">
            <label>Taller ID</label>
            <input type="number" name="taller_id" class="form-control">
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fecha Ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection