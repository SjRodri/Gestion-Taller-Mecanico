@extends('layouts.panel')

@section('page-title', 'Órdenes')

@section('content')

<div class="container-fluid">

    <!-- MENSAJES DE ÉXITO / ERROR -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- BUSCADOR -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('ordenes.index') }}" class="d-flex gap-2">

            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="buscar"
                    value="{{ request('buscar') }}"
                    class="form-control"
                    placeholder="Buscar orden...">
            </div>

            {{-- SELECT TALLER --}}
            <select name="taller_id" class="form-select">
                <option value="">Taller</option>
                @foreach ($talleres as $t)
                <option value="{{ $t->taller_id }}"
                    {{ request('taller_id') == $t->taller_id ? 'selected' : '' }}>
                    {{ $t->nombre }}
                </option>
                @endforeach
            </select>

            {{-- SELECT VEHÍCULO --}}
            <select name="vehiculo_id" class="form-select">
                <option value="">Vehículo</option>
                @foreach ($vehiculos as $v)
                <option value="{{ $v->vehiculo_id }}"
                    {{ request('vehiculo_id') == $v->vehiculo_id ? 'selected' : '' }}>
                    {{ $v->modelo }}
                </option>
                @endforeach
            </select>

            <!-- FILTRO POR FECHA -->
            <input type="date" name="fecha" class="form-control" value="{{ request('fecha') }}">

            <select name="estado" class="form-select">
                <option value="">Estado</option>
                <option value="activa" {{ request('estado')=='activa'?'selected':'' }}>Activas</option>
                <option value="espera" {{ request('estado')=='espera'?'selected':'' }}>En espera</option>
                <option value="finalizada" {{ request('estado')=='finalizada'?'selected':'' }}>Finalizadas</option>
                <option value="cancelada" {{ request('estado')=='cancelada'?'selected':'' }}>Canceladas</option>
            </select>

            <button class="btn btn-outline-secondary">
                <i class="fa-solid fa-filter"></i>
            </button>
        </form>

        <button class="btn btn-outline-success"
            onclick="window.location='{{ route('ordenes.create') }}'">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>

    <!-- TABLA -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table mb-0 table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Taller</th>
                        <th>Vehículos</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ordenes as $o)
                    <tr>
                        <td>ORD-{{ $o->orden_id }}</td>
                        <td>{{ $o->descripcion_orden }}</td>
                        <td>{{ $o->taller->nombre ?? '—' }}</td>
                        <td>{{ $o->vehiculo->modelo ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($o->fecha)->format('M d') }}</td>
                        <td>{{ $o->cliente->nombre }} {{ $o->cliente->apellido }}</td>
                        <td>
                            @php
                            $color = [
                            'activa' => 'primary',
                            'espera' => 'warning',
                            'finalizada' => 'success',
                            'cancelada' => 'danger'
                            ][$o->estado] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }}">
                                {{ ucfirst($o->estado) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('ordenes.edit', $o->orden_id) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button class="btn btn-outline-danger btn-sm"
                                onclick="abrirModalEliminar({{ $o->orden_id }})">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="mt-3">
        {{ $ordenes->links('pagination::bootstrap-5') }}
    </div>

</div>

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="formEliminar">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿La orden fue finalizada o cancelada?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="fw-bold">Seleccione una opción:</p>

                    <button type="submit" name="estado_final" value="finalizada"
                        class="btn btn-success w-100 mb-2">
                        Finalizada
                    </button>

                    <button type="submit" name="estado_final" value="cancelada"
                        class="btn btn-danger w-100">
                        Cancelada
                    </button>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function abrirModalEliminar(id) {
        document.getElementById('formEliminar').action =
            "{{ url('ordenes') }}/" + id;

        const modal = new bootstrap.Modal(document.getElementById('modalEliminar'));
        modal.show();
    }
</script>

@endsection