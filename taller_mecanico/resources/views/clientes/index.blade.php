@extends('layouts.panel')

@section('page-title', 'Listado de Clientes')

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

<!-- FILTROS -->
<div class="d-flex justify-content-between align-items-center mb-3">

    <form method="GET" action="{{ route('clientes.index') }}" class="d-flex gap-2">

        <input type="text" name="buscar" value="{{ request('buscar') }}"
            class="form-control" placeholder="Buscar cliente...">

        <button class="btn btn-outline-secondary">
            <i class="fa-solid fa-filter"></i>
        </button>
    </form>

    <button class="btn btn-outline-success"
        onclick="window.location='{{ route('clientes.create') }}'">
        <i class="fa-solid fa-plus"></i>
    </button>

</div>

<!-- TABLA -->
<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <table class="table table-hover mb-0 align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Teléfono</th>
                    <th>Vehículo</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>DNI</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($clientes as $cli)
                <tr>
                    <td>FIG-{{ $cli->cliente_id }}</td>
                    <td>{{ $cli->nombre ?? 'En Blanco' }}</td>
                    <td>{{ $cli->apellido ?? 'En Blanco' }}</td>
                    <td>{{ $cli->telefono ?? 'En Blanco' }}</td>
                    <td>{{ $cli->matricula ?? 'Sin vehículo' }}</td>
                    <td>{{ $cli->direccion ?? 'En Blanco' }}</td>
                    <td>{{ $cli->correo ?? 'En Blanco' }}</td>
                    <td>{{ $cli->dni ?? 'En Blanco' }}</td>

                    <td class="text-end">
                        <a href="{{ route('clientes.edit', $cli->cliente_id) }}"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <!--Funcional pero no queremos que se eliminen clientes de la base de datos<-
                         <form action="{{ route('clientes.destroy', $cli->cliente_id) }}"
                            method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('¿Eliminar este cliente?')">
                                <i class="fa-solid fa-xmark"></i>
                            </button> 
                        </form> -->
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center py-4">No hay clientes registrados</td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

<!-- PAGINACIÓN -->
<div class="mt-3">
    {{ $clientes->links('pagination::bootstrap-5') }}
</div>

@endsection