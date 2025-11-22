@extends('welcome')

@section('content')
<div style="padding: 20px;">
    <h2 style="font-size: 22px; margin-bottom: 20px;">⚙️ Configuración del Sistema</h2>

    <a href="{{ route('configuracion.create') }}" 
       style="display: inline-block; padding: 8px 12px; color: white; background: #222; border-radius: 5px; text-decoration: none; margin-bottom: 20px;">
        ➕ Agregar Configuración
    </a>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background: white;">
        <thead>
            <tr style="background: #ddd;">
                <th style="padding: 10px; border: 1px solid #ccc;">ID</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Clave</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Valor</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Descripción</th>
                <th style="padding: 10px; border: 1px solid #ccc;">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($configuraciones as $config)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $config->config_id }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $config->clave }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $config->valor }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $config->descripcion }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">
                        <a href="{{ route('configuracion.edit', $config->config_id) }}" 
                           style="padding: 5px 8px; background: #444; color: white; border-radius: 4px; text-decoration: none; margin-right:5px;">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('configuracion.destroy', $config->config_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="padding: 5px 8px; background: #c0392b; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                onclick="return confirm('¿Estás seguro de eliminar esta configuración?')">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
