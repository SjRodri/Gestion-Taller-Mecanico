<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla Admin - Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        .sidebar {
            width: 240px;
            background-color: #222;
            color: #fff;
            height: 100vh;
            position: fixed;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 18px;
            text-align: center;
        }

        .sidebar p {
            font-size: 12px;
            text-align: center;
            color: #aaa;
        }

        .sidebar nav {
            margin-top: 30px;
        }

        .sidebar nav a {
            display: block;
            color: #ddd;
            padding: 10px;
            text-decoration: none;
            border-radius: 6px;
        }

        .sidebar nav a:hover {
            background-color: #444;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .search-filter input[type="text"] {
            width: 250px;
            padding: 6px;
        }

        .table-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #333;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .add-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .add-button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Gestión de Talleres 🧰</h2>
        <p>Sayd Josue Rodríguez M.<br>example@gmail.com</p>
        <nav>
            <a href="{{ url('/') }}">🏠 Inicio</a>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                    <tr>
                        <td>FIG-{{ $cliente->cliente_id }}</td>
                        <td>{{ $cliente->nombre ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->apellido ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->telefono ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->matricula ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->direccion ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->correo ?? 'En Blanco' }}</td>
                        <td>{{ $cliente->dni ?? 'En Blanco' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center;">No hay clientes registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>