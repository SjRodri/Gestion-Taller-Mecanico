@extends('layouts.panel')

@section('page-title', 'Crear Cliente')

@section('content')
<div class="container">

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

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>DNI</label>
            <input type="text"
                name="dni"
                value="{{ old('dni') }}"
                maxlength="13"
                inputmode="numeric"
                pattern="[0-9]+"
                class="form-control @error('dni') is-invalid @enderror">
            @error('dni') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text"
                name="nombre"
                value="{{ old('nombre') }}"
                class="form-control @error('nombre') is-invalid @enderror"
                required>
            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Apellido</label>
            <input type="text"
                name="apellido"
                value="{{ old('apellido') }}"
                class="form-control @error('apellido') is-invalid @enderror"
                required>
            @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
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
            @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Vehículo / Matrícula</label>
            <input type="text"
                name="matricula"
                value="{{ old('matricula') }}"
                class="form-control @error('matricula') is-invalid @enderror">
            @error('matricula') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text"
                name="direccion"
                value="{{ old('direccion') }}"
                class="form-control @error('direccion') is-invalid @enderror">
            @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email"
                name="correo"
                value="{{ old('correo') }}"
                class="form-control @error('correo') is-invalid @enderror">
            @error('correo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary ms-2">Cerrar</a>
    </form>
</div>
@endsection