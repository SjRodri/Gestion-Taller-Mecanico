@extends('layouts.panel')

@section('page-title', 'Crear Orden')

@section('content')

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form method="POST" action="{{ route('ordenes.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion_orden" required>{{ old('descripcion_orden') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach ($clientes as $c)
                        <option value="{{ $c->cliente_id }}" {{ old('cliente_id') == $c->cliente_id ? 'selected' : '' }}>
                            {{ $c->nombre }} {{ $c->apellido }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Taller</label>
                    <select name="taller_id" class="form-select" required>
                        <option value="">Seleccione</option>
                        @foreach ($talleres as $t)
                        <option value="{{ $t->taller_id }}" {{ old('taller_id') == $t->taller_id ? 'selected' : '' }}>
                            {{ $t->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="vehiculo_id" class="form-select">
                        <option value="">Ninguno</option>
                        @foreach ($vehiculos as $v)
                        <option value="{{ $v->vehiculo_id }}" {{ old('vehiculo_id') == $v->vehiculo_id ? 'selected' : '' }}>
                            {{ $v->marca }} - {{ $v->modelo }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha"
                        value="{{ old('fecha') }}"
                        min="{{ date('Y-m-d') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <input type="text" class="form-control" value="Activa" disabled>
                </div>

                <button class="btn btn-success">Crear Orden</button>
                <a href="{{ route('ordenes.index') }}" class="btn btn-secondary">Cancelar</a>

            </form>

        </div>
    </div>

</div>

@endsection
