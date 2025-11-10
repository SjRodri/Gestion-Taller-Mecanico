@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Empleados</h2>

  <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-striped">
    <thead>
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
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($empleados as $emp)
      <tr>
        <td>{{ $emp->empleado_id }}</td>
        <td>{{ $emp->dni }}</td>
        <td>{{ $emp->nombre }}</td>
        <td>{{ $emp->apellido }}</td>
        <td>{{ $emp->telefono }}</td>
        <td>{{ $emp->rol }}</td>
        <td>{{ $emp->taller_id }}</td>
        <td>{{ $emp->correo }}</td>
        <td>{{ $emp->fecha_ingreso }}</td>
        <td>{{ $emp->activo ? 'Sí' : 'No' }}</td>
        <td>
          <a href="{{ route('empleados.edit', $emp->empleado_id) }}" class="btn btn-warning btn-sm">Editar</a>
          <form action="{{ route('empleados.destroy', $emp->empleado_id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este empleado?')">Eliminar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
