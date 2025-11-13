@extends('layouts.app')

@section('title', 'Nuevo Repuesto')
@section('page-title', 'Nuevo Repuesto')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Agregar Repuesto</h5>
        <a href="{{ route('repuestos.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('repuestos.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="descripcion_repuesto" class="form-label">Descripción del Repuesto</label>
                    <input 
                        type="text" 
                        name="descripcion_repuesto" 
                        id="descripcion_repuesto" 
                        class="form-control @error('descripcion_repuesto') is-invalid @enderror"
                        value="{{ old('descripcion_repuesto') }}" 
                        required>
                    @error('descripcion_repuesto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="categoria" class="form-label">Categoría</label>
                    <input 
                        type="text" 
                        name="categoria" 
                        id="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror"
                        value="{{ old('categoria') }}" 
                        required>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input 
                        type="number" 
                        name="precio" 
                        id="precio" 
                        class="form-control @error('precio') is-invalid @enderror"
                        value="{{ old('precio') }}" 
                        step="0.01" 
                        required>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input 
                        type="number" 
                        name="cantidad" 
                        id="cantidad" 
                        class="form-control @error('cantidad') is-invalid @enderror"
                        value="{{ old('cantidad') }}" 
                        required>
                    @error('cantidad')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="reorder_threshold" class="form-label">Reorder Threshold</label>
                    <input 
                        type="number" 
                        name="reorder_threshold" 
                        id="reorder_threshold" 
                        class="form-control @error('reorder_threshold') is-invalid @enderror"
                        value="{{ old('reorder_threshold') }}">
                    @error('reorder_threshold')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
                <a href="{{ route('repuestos.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
