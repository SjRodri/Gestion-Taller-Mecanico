@extends('layouts.app')

@section('title', 'Repuestos')
@section('page-title', 'Repuestos')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Listado de Repuestos</h5>
        
        <a href="{{ route('repuestos.create') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-plus"></i> Agregar Repuesto
        </a>
    </div>

    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif

        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Reorder Threshold</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($repuestos as $rep)
                    <tr>
                        <td>{{ $rep->repuesto_id }}</td>
                        <td>{{ $rep->descripcion_repuesto }}</td>
                        <td>{{ $rep->categoria }}</td>
                        <td>${{ number_format($rep->precio, 2) }}</td>
                        <td>{{ $rep->cantidad }}</td>
                        <td>{{ $rep->reorder_threshold }}</td>
                        <td class="text-end">
                            <!-- Botón Editar -->
                            <a href="{{ route('repuestos.edit', $rep->repuesto_id) }}" 
                               class="btn btn-sm btn-outline-primary" title="Editar">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('repuestos.destroy', $rep->repuesto_id) }}" 
                                  method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar"
                                        onclick="return confirm('¿Seguro que deseas eliminar este repuesto?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">
                            No hay repuestos registrados aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
