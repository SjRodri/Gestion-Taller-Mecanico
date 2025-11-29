<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla Admin - Clientes</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    <div class="sidebar">
        <h2>Gestión de Talleres 🧰</h2>
        <p>Sayd Josue Rodríguez M.<br>example@gmail.com</p>

        <nav>
            <a href="{{ url('dashboard') }}">🏠 Inicio</a>
            <a href="#" style="background-color:#444;">👥 Clientes</a>
            <a href="#">🏭 Gestión de Talleres</a>
            <a href="#">🧑‍🔧 Empleados</a>
            <a href="#">📊 Reportes</a>
            <a href="#">🔧 Repuestos</a>
            <a href="#">⚙️ Configuración</a>
        </nav>
    </div>

    <div class="content">
        <h1>Clientes</h1>

        <div class="search-filter">
            <input type="text" placeholder="Buscar cliente...">
            <button class="add-button" onclick="window.location.href='{{ url('/clientes/create') }}'">+ Agregar Cliente</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Vehículo</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>DNI</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($clientes as $cliente)
                    <tr>
                        <td>FIG-{{ $cliente->cliente_id }}</td>
                        <td>{{ $cliente->nombre ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->apellido ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->telefono ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->matricula ?? 'Sin vehículo' }}</td>
                        <td>{{ $cliente->direccion ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->correo ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->dni ?? 'En Blanco' }}</td>

                        <td class="action-buttons">
                            <a href="{{ url('clientes/'.$cliente->cliente_id.'/edit') }}">Editar</a>

                            <form action="{{ url('clientes/'.$cliente->cliente_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar cliente?');">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align:center;">No hay clientes registrados</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</body>

</html>