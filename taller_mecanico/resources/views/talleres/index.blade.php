@extends('layouts.app')

@section('page-title', 'Listado de Talleres')

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between mb-3">

    <form method="GET" class="d-flex gap-2">
        <input type="text" name="buscar" class="form-control"
            placeholder="Buscar por nombre, ubicación, teléfono..."
            value="{{ $buscar }}">
        <button class="btn btn-primary">Buscar</button>
    </form>

    <a href="{{ route('talleres.create') }}" class="btn btn-success" style="font-size: 20px;">
        +
    </a>

</div>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0">
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