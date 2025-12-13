@extends('layouts.panel')

@section('page-title', 'Editar Vehículo')

@section('content')

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Mensajes de error --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('vehiculos.update', $vehiculo->vehiculo_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Matrícula</label>
                    <input type="text" class="form-control" name="matricula"
                        value="{{ old('matricula', $vehiculo->matricula) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Modelo</label>
                    <input type="text" class="form-control" name="modelo"
                        value="{{ old('modelo', $vehiculo->modelo) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Año</label>
                    <input type="number" class="form-control" name="ano"
                        min="1900" max="2099"
                        value="{{ old('ano', $vehiculo->ano) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <input type="text" class="form-control" name="color"
                        value="{{ old('color', $vehiculo->color) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">VIN</label>
                    <input type="text" class="form-control" name="vin"
                        value="{{ old('vin', $vehiculo->vin) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach ($clientes as $cli)
                        <option value="{{ $cli->cliente_id }}">
                            {{ $cli->nombre }} {{ $cli->apellido }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">Actualizar Vehículo</button>
                <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>

            </form>
        </div>
    </div>
</div>

@endsection