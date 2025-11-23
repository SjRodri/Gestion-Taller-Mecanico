<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>

    <link rel="stylesheet" href="{{ asset('css/datos.css') }}">
</head>

<body>

    <div class="container">
        <h1>Editar Cliente</h1>

        <form action="{{ url('clientes/'.$cliente->cliente_id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="dni">DNI</label>
            <input type="text" name="dni" value="{{ $cliente->dni }}">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" required>

            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" value="{{ $cliente->apellido }}" required>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}">

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" value="{{ $cliente->direccion }}">

            <label for="correo">Correo</label>
            <input type="email" name="correo" value="{{ $cliente->correo }}">

            <button type="submit">Actualizar</button>
        </form>

        <a href="{{ url('clientes') }}">⟵ Volver a la lista</a>
    </div>

</body>

</html>