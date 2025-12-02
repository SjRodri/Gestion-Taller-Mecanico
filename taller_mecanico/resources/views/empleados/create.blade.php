@extends('layouts.panel')

@section('content')
<div class="container">
    <h2>Crear Empleado</h2>

    {{-- MENSAJES DE ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>DNI</label>
            <input type="text"
                name="dni"
                value="{{ old('dni') }}"
                maxlength="13"
                inputmode="numeric"
                pattern="[0-9]+"
                class="form-control @error('dni') is-invalid @enderror"
                required>
            @error('dni')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text"
                name="nombre"
                value="{{ old('nombre') }}"
                class="form-control @error('nombre') is-invalid @enderror"
                required>
            @error('nombre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text"
                name="apellido"
                value="{{ old('apellido') }}"
                class="form-control @error('apellido') is-invalid @enderror"
                required>
            @error('apellido')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text"
                name="telefono"
                value="{{ old('telefono') }}"
                maxlength="8"
                inputmode="numeric"
                pattern="[0-9]+"
                class="form-control @error('telefono') is-invalid @enderror">
            @error('telefono')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Rol</label>
            <input type="text"
                name="rol"
                value="{{ old('rol') }}"
                class="form-control @error('rol') is-invalid @enderror"
                required>
            @error('rol')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Taller</label>
            <select name="taller_id"
                class="form-control @error('taller_id') is-invalid @enderror"
                required>
                <option value="">Seleccione un taller</option>
                @foreach($talleres as $t)
                    <option value="{{ $t->taller_id }}" {{ old('taller_id') == $t->taller_id ? 'selected' : '' }}>
                        {{ $t->nombre }}
                    </option>
                @endforeach
            </select>
            @error('taller_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email"
                name="correo"
                value="{{ old('correo') }}"
                class="form-control @error('correo') is-invalid @enderror"
                required>
            @error('correo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Fecha de ingreso</label>
            <input type="date"
                name="fecha_ingreso"
                min="{{ date('Y-m-d') }}"
                value="{{ old('fecha_ingreso') }}"
                class="form-control @error('fecha_ingreso') is-invalid @enderror"
                required>
            @error('fecha_ingreso')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label>Activo</label>
            <select name="activo" class="form-control">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary ms-2">Cerrar</a>
    </form>
</div>
@endsection
