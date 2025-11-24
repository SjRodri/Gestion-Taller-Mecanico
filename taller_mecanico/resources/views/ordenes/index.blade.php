@extends('layouts.app')

@section('page-title', 'Órdenes')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <form method="GET" action="{{ route('ordenes.index') }}" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="buscar" value="{{ request('buscar') }}"
                    class="form-control" placeholder="Buscar orden...">
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

        <a href="{{ route('ordenes.create') }}" class="btn btn-outline-success">
            <i class="fa-solid fa-plus"></i>
        </a>
    </div>

    <!-- Tabla estilo moderno -->
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
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ordenes as $o)
                    <tr>
                        <td>ORD-{{ $o->orden_id }}</td>
                        <td>{{ $o->descripcion_orden }}</td>
                        <td>{{ $o->taller->nombre ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($o->fecha)->format('M d') }}</td>
                        <td>
                            {{ $o->cliente->nombre ?? '' }} {{ $o->cliente->apellido ?? '' }}
                        </td>

                        <td class="text-end">

                            <!-- Botón editar -->
                            <a href="{{ route('ordenes.edit', $o->orden_id) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Botón eliminar -->
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


<!-- Modal eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="formEliminar">
            @csrf
            @method('DELETE')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar estado de la orden</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <p>¿La orden fue cancelada o finalizada?</p>

                    <select class="form-select" name="motivo" required>
                        <option value="cancelada">Cancelada</option>
                        <option value="finalizada">Finalizada</option>
                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button class="btn btn-danger">Guardar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
function abrirModalEliminar(id) {
    const url = "{{ url('ordenes') }}/" + id;
    document.getElementById('formEliminar').action = url;
    new bootstrap.Modal(document.getElementById('modalEliminar')).show();
}
</script>

@endsection
