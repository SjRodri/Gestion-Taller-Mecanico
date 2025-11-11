@extends('layouts.app')

@section('title', 'Empleados')
@section('page-title', 'Empleados')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif

        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Taller</th>
                    <th>DNI</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $emp)
                    <tr>
                        <td>{{ $emp->empleado_id }}</td>
                        <td>{{ $emp->nombre }}</td>
                        <td>{{ $emp->apellido }}</td>
                        <td>{{ $emp->telefono }}</td>
                        <td>{{ $emp->rol }}</td>
                        <td>{{ $emp->taller_id }}</td>
                        <td>{{ $emp->dni }}</td>
                        <td class="text-end">
                            <!-- Botón Editar -->
                            <a href="{{ route('empleados.edit', $emp->empleado_id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('empleados.destroy', $emp->empleado_id) }}" 
                                  method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar este empleado?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
