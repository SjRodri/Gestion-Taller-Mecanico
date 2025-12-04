@extends('layouts.app')

@section('title','Editar Reporte')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h5">Editar Reporte</h1>
        <a href="{{ route('reportes.index') }}" class="btn btn-sm btn-secondary">Volver</a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('reportes.update', $reporte->reporte_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" 
                           value="{{ old('fecha', $reporte->fecha) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="descripcion_reporte" class="form-control" 
                           value="{{ old('descripcion_reporte', $reporte->descripcion_reporte) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total</label>
                    <input type="number" step="0.01" name="total" class="form-control" 
                           value="{{ old('total', $reporte->total) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Clientes Nuevos</label>
                        <input type="number" name="clientes_nuevos" class="form-control" 
                               value="{{ old('clientes_nuevos', $reporte->clientes_nuevos) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Repuestos Ordenados</label>
                        <input type="number" name="repuestos_ordenados" class="form-control" 
                               value="{{ old('repuestos_ordenados', $reporte->repuestos_ordenados) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Taller ID</label>
                    <input type="number" name="taller_id" class="form-control" 
                           value="{{ old('taller_id', $reporte->taller_id) }}">
                </div>

                <button class="btn btn-primary">Actualizar</button>
                <a href="{{ route('reportes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection

