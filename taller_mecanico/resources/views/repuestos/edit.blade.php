@extends('layouts.app')

@section('title', 'Editar Repuesto')
@section('page-title', 'Editar Repuesto')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Editar Repuesto</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('repuestos.update', $repuesto->repuesto_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre del Repuesto</label>
                <input type="text" name="descripcion_repuesto" 
                       value="{{ $repuesto->descripcion_repuesto }}" 
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <input type="text" name="categoria" 
                       value="{{ $repuesto->categoria }}" 
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" step="0.01"
                       value="{{ $repuesto->precio }}" 
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" 
                       value="{{ $repuesto->cantidad }}" 
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Reordenar Producto</label>
                <input type="number" name="reorder_threshold"
                       value="{{ $repuesto->reorder_threshold }}" 
                       class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                Actualizar
            </button>

            <a href="{{ route('repuestos.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </form>
    </div>
</div>
@endsection
