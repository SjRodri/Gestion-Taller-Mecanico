<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 60px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            margin-top: 15px;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }

        .error {
            color: red;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Agregar Cliente</h1>

        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ url('/clientes') }}" method="POST">
            @csrf
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni">

            <label for="nombre">Nombre *</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="apellido">Apellido *</label>
            <input type="text" name="apellido" id="apellido" required>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono">

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion">

            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo">

            <button type="submit">Guardar Cliente</button>
        </form>

        <a href="{{ url('/clientes') }}">⬅ Volver al listado</a>
    </div>
</body>

</html>