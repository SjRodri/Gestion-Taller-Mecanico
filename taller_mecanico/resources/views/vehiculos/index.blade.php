<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla Admin - Vehiculos</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    <div class="sidebar">
        <h2>Gestión de Talleres 🧰</h2>
        <p>Sayd Josue Rodríguez M.<br>example@gmail.com</p>

        <nav>
            <a href="{{ url('/') }}">🏠 Inicio</a>
            <a href="#" style="background-color:#444;">👥 Vehiculos</a>
            <a href="#">🏭 Gestión de Talleres</a>
            <a href="#">🧑‍🔧 Empleados</a>
            <a href="#">📊 Reportes</a>
            <a href="#">🔧 Repuestos</a>
            <a href="#">⚙️ Configuración</a>
        </nav>
    </div>

    <div class="content">
        <h1>vehiculos</h1>

        <div class="search-filter">
            <input type="text" placeholder="Buscar vehiculo...">
            <form action="{{ url('/vehiculos/create') }}" method="GET" style="display:inline;">
                <button type="submit">+ Agregar Vehículo</button>
            </form>


        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Color</th>
                        <th>Vin</th>
                        <th>Propietario</th>

                    </tr>
                </thead>

                <tbody>
                    @forelse ($vehiculos as $vehiculo)
                    <tr>
                        <td>FIG-{{ $vehiculo->cliente->vehiculo_id ?? 'Sin ID' }}</td>
                        <td>{{ $vehiculo->cliente->nombre ?? 'En Blanco' }}</td>
                        <td>{{ $vehiculo->cliente->apellido ?? 'En Blanco' }}</td>
                        <td>{{ $vehiculo->cliente->telefono ?? 'En Blanco' }}</td>
                        <td>{{ $vehiculo->matricula ?? 'Sin vehículo' }}</td>
                        <td>{{ $vehiculo->cliente->direccion ?? 'En Blanco' }}</td>
                        <td>{{ $vehiculo->cliente->correo ?? 'En Blanco' }}</td>
                        <td>{{ $vehiculo->cliente->dni ?? 'En Blanco' }}</td>
                        <td>Acciones aquí</td>


                        <td class="action-buttons">
                            <a href="{{ url('vehiculos/'.$vehiculo->vehiculo_id.'/edit') }}">Editar</a>

                            <form action="{{ url('vehiculos/'.$vehiculo->vehiculo_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar Vehiculo?');">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align:center;">No hay Vehiculos registrados</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</body>

</html>