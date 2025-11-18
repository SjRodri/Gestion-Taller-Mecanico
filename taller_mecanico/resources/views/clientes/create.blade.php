<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="{{ asset('css/datos.css') }}">
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