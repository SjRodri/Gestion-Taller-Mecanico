@extends('layouts.panel')

@section('page-title', 'Listado de Empleados')

@section('content')

@if(session('success'))
<div class="alert alert-success" id="alert-msg">{{ session('success') }}</div>
@endif

<script>
    setTimeout(() => {
        let alert = document.getElementById('alert-msg');
        if (alert) alert.style.display = 'none';
    }, 20000);
</script>

<!-- FILTROS SOLO EN INDEX -->
<div class="d-flex justify-content-between align-items-center mb-3">

    <form method="GET" action="{{ route('empleados.index') }}" class="d-flex gap-2">

        <input type="text" name="buscar" value="{{ request('buscar') }}"
            class="form-control" placeholder="Buscar empleado...">

        <select name="rol" class="form-select">
            <option value="">Rol</option>
            <option value="Administrador" {{ request('rol') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="Mecánico General" {{ request('rol') == 'Mecánico General' ? 'selected' : '' }}>Mecánico General</option>
            <option value="Recepcionista" {{ request('rol') == 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
            <option value="Electricista Automotriz" {{ request('rol') == 'Electricista Automotriz' ? 'selected' : '' }}>Electricista Automotriz</option>
            <option value="Pintor Automotriz" {{ request('rol') == 'Pintor Automotriz' ? 'selected' : '' }}>Pintor Automotriz</option>
            <option value="Asistente de Taller" {{ request('rol') == 'Asistente de Taller' ? 'selected' : '' }}>Asistente de Taller</option>
            <option value="Técnico en Diagnóstico" {{ request('rol') == 'Técnico en Diagnóstico' ? 'selected' : '' }}>Técnico en Diagnóstico</option>
            <option value="Contador" {{ request('rol') == 'Contador' ? 'selected' : '' }}>Contador</option>
            <option value="Mecánico Diesel" {{ request('rol') == 'Mecánico Diesel' ? 'selected' : '' }}>Mecánico Diesel</option>
        </select>

        <select name="activo" class="form-select">
            <option value="">Activo</option>
            <option value="1" {{ request('activo') === '1' ? 'selected' : '' }}>Sí</option>
            <option value="0" {{ request('activo') === '0' ? 'selected' : '' }}>No</option>
        </select>

        <!-- ESTE FILTRO ESTABA ANTES EN EL LAYOUT -->
        <select name="taller" class="form-select">
            <option value="">Taller</option>
            @foreach ($talleres as $t)
            <option value="{{ $t->taller_id }}" {{ request('taller') == $t->taller_id ? 'selected' : '' }}>
                {{ $t->nombre }}
            </option>
            @endforeach
        </select>

        <button class="btn btn-outline-secondary"><i class="fa-solid fa-filter"></i></button>
    </form>

    <button class="btn btn-outline-success"
        onclick="window.location='{{ route('empleados.create') }}'">
        <i class="fa-solid fa-plus"></i>
    </button>

</div>

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
                        <a href="{{ route('empleados.edit', $emp->empleado_id) }}"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

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