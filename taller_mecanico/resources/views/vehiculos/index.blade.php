@extends('layouts.panel')

@section('page-title', 'Vehículos')

@section('content')

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- FILTROS --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <form method="GET" class="d-flex gap-2">

        {{-- BUSCAR --}}
        <div class="input-group">
            <span class="input-group-text bg-white">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text"
                name="buscar"
                class="form-control"
                placeholder="Buscar vehículo..."
                value="{{ request('buscar') }}">
        </div>

        {{-- FILTRAR POR PROPIETARIO --}}
        <select name="cliente" class="form-select">
            <option value="">Propietario</option>
            @foreach($clientes as $c)
            <option value="{{ $c->cliente_id }}"
                {{ request('cliente') == $c->cliente_id ? 'selected' : '' }}>
                {{ $c->nombre }} {{ $c->apellido }}
            </option>
            @endforeach
        </select>

        {{-- FILTRAR POR AÑO --}}
        <select name="anio" class="form-select">
            <option value="">Año</option>
            @foreach($anos as $a)
            <option value="{{ $a }}" {{ request('ano') == $a ? 'selected' : '' }}>
                {{ $a }}
            </option>
            @endforeach
        </select>

        <button class="btn btn-outline-secondary">
            <i class="fa-solid fa-filter"></i>
        </button>
    </form>

    {{-- BOTÓN + --}}
    <a href="{{ route('vehiculos.create') }}"
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
                    <th>Matrícula</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>VIN</th>
                    <th>Propietario</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($vehiculos as $v)
                <tr>
                    <td>{{ $v->matricula }}</td>
                    <td>{{ $v->modelo }}</td>
                    <td>{{ $v->ano }}</td>
                    <td>{{ $v->color }}</td>
                    <td>{{ $v->vin }}</td>

                    <td>
                        @if($v->cliente)
                        {{ $v->cliente->nombre }} {{ $v->cliente->apellido }}
                        @else
                        <span class="text-muted">Sin propietario</span>
                        @endif
                    </td>

                    <td class="text-end">
                        <a href="{{ route('vehiculos.edit', $v->vehiculo_id) }}"
                            class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        <form action="{{ route('vehiculos.destroy', $v->vehiculo_id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('¿Eliminar este vehículo?')">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-3">
                        No hay vehículos registrados
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



@endsection