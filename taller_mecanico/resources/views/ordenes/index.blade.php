@extends('layouts.app')

@section('page-title', 'Órdenes')

@section('content')

<div class="container-fluid">

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
<div class="modal fade" id="modalEliminar">
    <div class="modal-dialog">
        <form method="POST" id="formEliminar">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Qué ocurrió con la orden?</h5>
                </div>

                <div class="modal-body">
                    <select name="motivo" class="form-select" required>
                        <option value="">Seleccione opción</option>
                        <option value="cancelada">Cancelar orden</option>
                        <option value="finalizada">Marcar como finalizada</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-danger">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function abrirModalEliminar(id) {
    document.getElementById('formEliminar').action = "/ordenes/" + id;
    new bootstrap.Modal(document.getElementById('modalEliminar')).show();
}
</script>

@endsection
