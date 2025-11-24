@extends('layouts.app')

@section('page-title', 'Crear Orden')

@section('content')

<div class="container">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('ordenes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion_orden" class="form-control" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="cliente_id" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            @foreach ($clientes as $c)
                                <option value="{{ $c->cliente_id }}">{{ $c->nombre }} {{ $c->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Taller</label>
                        <select name="taller_id" class="form-select">
                            <option value="">Ninguno</option>
                            @foreach ($talleres as $t)
                                <option value="{{ $t->taller_id }}">{{ $t->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Vehículo</label>
                        <select name="vehiculo_id" class="form-select">
                            <option value="">Ninguno</option>
                            @foreach ($vehiculos as $v)
                                <option value="{{ $v->vehiculo_id }}">{{ $v->matricula }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>

                <button class="btn btn-success">Guardar</button>
                <a href="{{ route('ordenes.index') }}" class="btn btn-outline-secondary">Cancelar</a>

            </form>

        </div>
    </div>

</div>

@endsection
