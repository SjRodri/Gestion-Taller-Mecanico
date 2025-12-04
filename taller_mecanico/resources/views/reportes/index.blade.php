@extends('layouts.app')

@section('page-title', 'Reporte de Ventas')

@section('content')

<div class="container-fluid">

    <!-- encabezao -->
    <div class="d-flex justify-content-between align-items-center mb-3">


        <div class="d-flex gap-2">

            <!-- botoncito pdf -->
            <a href="{{ route('reportes.export.pdf') }}" 
                class="btn btn-danger">
                <i class="fa-solid fa-file-pdf"></i> PDF
            </a>

            <!-- Botón Nuevo Reporte -->
            <a href="{{ route('reportes.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Nuevo
            </a>

        </div>
    </div>

    <!-- tablita :) -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table mb-0 table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Total</th>
                        <th>Clientes Nuevos</th>
                        <th>Repuestos</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reportes as $r)
                    <tr>
                        <td>{{ $r->fecha }}</td>
                        <td>{{ $r->descripcion_reporte }}</td>
                        <td>${{ number_format($r->total, 2) }}</td>
                        <td>{{ $r->clientes_nuevos }}</td>
                        <td>{{ $r->repuestos_ordenados }}</td>

                        <td class="text-end">

                            <!-- Editar -->
                            <a href="{{ route('reportes.edit', $r->reporte_id) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Eliminar -->
                            <form action="{{ route('reportes.destroy', $r->reporte_id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('¿Eliminar reporte?')">
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

</div>

@endsection
