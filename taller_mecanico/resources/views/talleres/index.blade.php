@extends('layouts.app')

@section('page-title', 'Talleres')

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- FILTROS --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <form method="GET" class="d-flex gap-2">

        {{-- INPUT CON ICONO (BUSCADOR GENERAL) --}}
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar"
                value="{{ $buscar }}">
        </div>

        {{--SELECT NUEVO: FILTRAR POR NOMBRE EXACTO --}}
        <select name="nombre_select" class="form-select">
            <option value="">Nombre</option>
            @foreach($nombresTalleres as $item)
            <option value="{{ $item->nombre }}"
                {{ request('nombre_select') == $item->nombre ? 'selected' : '' }}>
                {{ $item->nombre }}
            </option>
            @endforeach
        </select>

        {{-- SELECT UBICACIÓN (ahora igual que Nombre) --}}
        <select name="ubicacion" class="form-select">
            <option value="">Ubicación</option>
            @foreach($ubicacionesTalleres as $u)
            <option value="{{ $u->ubicacion }}"
                {{ request('ubicacion') == $u->ubicacion ? 'selected' : '' }}>
                {{ $u->ubicacion }}
            </option>
            @endforeach
        </select>

        {{-- BOTÓN FILTRAR --}}
        <button class="btn btn-outline-secondary">
            <i class="fa-solid fa-filter"></i>
        </button>

    </form>

    {{-- BOTÓN + --}}
    <a href="{{ route('talleres.create') }}"
        class="btn btn-outline-success rounded-3"
        style="font-size: 22px; padding: 4px 12px;">
        +
    </a>
</div>

{{-- TABLA --}}
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Horario</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($talleres as $t)
                <tr>
                    <td>{{ $t->taller_id }}</td>
                    <td>{{ $t->nombre }}</td>
                    <td>{{ $t->ubicacion }}</td>
                    <td>{{ $t->telefono }}</td>
                    <td>{{ $t->email }}</td>
                    <td>{{ $t->horario }}</td>
                    <td>{{ $t->latitude }}</td>
                    <td>{{ $t->longitude }}</td>

                    <td class="text-end">
                        <a href="{{ route('talleres.edit', $t->taller_id) }}"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('talleres.destroy', $t->taller_id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('¿Eliminar este taller?')">
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
    {{ $talleres->links('pagination::bootstrap-5') }}
</div>

@endsection