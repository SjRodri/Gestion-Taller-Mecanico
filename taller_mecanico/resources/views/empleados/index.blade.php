@extends('layouts.app')

@section('page-title', 'Listado de Empleados')

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <table class="table table-hover mb-0 align-middle">
            <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Taller</th>
                    <th>Correo</th>
                    <th>Fecha Ingreso</th>
                    <th>Activo</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($empleados as $emp)
                <tr>
                    <td>{{ $emp->empleado_id }}</td>
                    <td>{{ $emp->dni }}</td>
                    <td>{{ $emp->nombre }}</td>
                    <td>{{ $emp->apellido }}</td>
                    <td>{{ $emp->telefono }}</td>
                    <td>{{ $emp->rol }}</td>
                    <td>{{ $emp->taller->nombre ?? '—' }}</td>
                    <td>{{ $emp->correo }}</td>
                    <td>{{ $emp->fecha_ingreso }}</td>
                    <td>{{ $emp->activo ? 'Sí' : 'No' }}</td>

                    <td class="text-end">

                        <!-- BOTÓN EDITAR IGUAL A ÓRDENES -->
                        <a href="{{ route('empleados.edit', $emp->empleado_id) }}"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <!-- BOTÓN ELIMINAR IGUAL A ÓRDENES -->
                        <form action="{{ route('empleados.destroy', $emp->empleado_id) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('¿Eliminar este empleado?')">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<div class="mt-3">
    {{ $empleados->links('pagination::bootstrap-5') }}
</div>

@endsection