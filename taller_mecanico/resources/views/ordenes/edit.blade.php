@extends('layouts.app')

@section('page-title', 'Editar Orden')

@section('content')

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('ordenes.update', $orden->orden_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion_orden" class="form-control" required>{{ $orden->descripcion_orden }}</textarea>
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            @foreach ($clientes as $c)
                            <option value="{{ $c->cliente_id }}"
                                {{ $orden->cliente_id == $c->cliente_id ? 'selected' : '' }}>
                                {{ $c->nombre }} {{ $c->apellido }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Taller</label>
                        <select name="taller_id" class="form-select">
                            <option value="">Ninguno</option>
                            @foreach ($talleres as $t)
                            <option value="{{ $t->taller_id }}"
                                {{ $orden->taller_id == $t->taller_id ? 'selected' : '' }}>
                                {{ $t->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Vehículo</label>
                        <select name="vehiculo_id" class="form-select">
                            <option value="">Ninguno</option>
                            @foreach ($vehiculos as $v)
                            <option value="{{ $v->vehiculo_id }}"
                                {{ $orden->vehiculo_id == $v->vehiculo_id ? 'selected' : '' }}>
                                {{ $v->matricula }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="{{ $orden->fecha }}" required>
                </div>

                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('ordenes.index') }}" class="btn btn-outline-secondary">Cancelar</a>

            </form>

        </div>
    </div>

</div>

@endsection