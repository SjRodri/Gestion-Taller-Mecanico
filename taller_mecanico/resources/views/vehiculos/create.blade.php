<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vehiculo</title>
    <link rel="stylesheet" href="{{ asset('css/datos.css') }}">
</head>

<body>
    <div class="container">
       

        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @extends('layouts.panel')

        @section('content')
        <div class="container">
            <h1>Registrar Vehículo</h1>

            <form action="{{ route('vehiculos.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="matricula" class="form-label">Matrícula</label>
                    <input type="text" name="matricula" id="matricula" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input type="text" name="modelo" id="modelo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="ano" class="form-label">Año</label>
                    <input type="number" name="ano" id="ano" class="form-control" min="1900" max="2099">
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" name="color" id="color" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="vin" class="form-label">VIN</label>
                    <input type="text" name="vin" id="vin" class="form-control">
                </div>




        </div>

        <button type="submit" class="btn btn-primary">Registrar vehículo</button>
        </form>
    </div>
    @endsection

    </div>
</body>

</html>