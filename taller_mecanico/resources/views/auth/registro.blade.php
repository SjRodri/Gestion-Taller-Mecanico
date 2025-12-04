<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            background-color: #ffffff;
            border: 2px solid #007bff;
            border-radius: 15px;
            padding: 20px;
            /* Reducido de 30px para compactar */
            width: 100%;
            max-width: 550px;
            /* Reducido ligeramente para evitar scroll innecesario en pantallas pequeñas */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            color: #212529;
        }

        .btn-registro {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            font-weight: 600;
        }

        /* Estilos para seccionar y compactar */
        .section-title {
            color: #007bff;
            font-size: 1rem;
            /* Reducido para compactar */
            font-weight: 600;
            margin-top: 15px;
            /* Reducido */
            margin-bottom: 10px;
            /* Reducido */
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 3px;
            /* Reducido */
        }

        .form-section {
            margin-bottom: 15px;
            /* Reducido de 25px para compactar */
        }

        .row {
            margin-bottom: 8px;
            /* Reducido para menos espacio entre filas */
        }

        .mb-3 {
            margin-bottom: 0.75rem !important;
            /* Reducido ligeramente para compactar */
        }

        .text-center.mb-4 {
            margin-bottom: 2rem !important;
            /* Ajuste para el título principal */
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="text-center mb-4">Registro de Cliente</h3>

        {{-- Mensajes de error --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Flash message --}}
        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('registrar') }}" method="POST">
            @csrf

            <!-- Sección: Información Personal -->
            <div class="form-section">
                <h5 class="section-title">Información Personal</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" value="{{ old('dni') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" name="nombre" class="form-control" required value="{{ old('nombre') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido *</label>
                        <input type="text" name="apellido" class="form-control" required value="{{ old('apellido') }}">
                    </div>
                </div>
            </div>

            <!-- Sección: Información de Contacto -->
            <div class="form-section">
                <h5 class="section-title">Información de Contacto</h5>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo *</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
            </div>

            <!-- Sección: Seguridad -->
            <div class="form-section">
                <h5 class="section-title">Seguridad</h5>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña *</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-registro">Registrarse</button>
                <a href="{{ route('login') }}" class="btn btn-light border text-center">Iniciar Sesión</a>
            </div>
        </form>
    </div>

</body>

</html>