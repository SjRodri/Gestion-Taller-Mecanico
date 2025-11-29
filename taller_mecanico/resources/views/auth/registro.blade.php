<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
            padding: 30px;
            width: 100%;
            max-width: 400px;
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
    </style>
</head>

<body>
    <div class="card">
        <h3 class="text-center mb-4">Registro</h3>

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

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('registrar') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="rol" class="form-label">Registrarme como:</label>
                <select name="rol" id="rol" class="form-select" required>
                    <option value="cliente">Cliente</option>
                    <option value="empleado">Empleado</option>
                </select>
            </div>

            <div class="mb-3 d-none" id="puestoContainer">
                <label for="puesto" class="form-label">Puesto (empleado)</label>
                <input type="text" name="puesto" class="form-control"
                    placeholder="Mecánico, Administrador, etc.">
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-registro">Registrarse</button>
                <a href="{{ route('login') }}" class="btn btn-light border text-center">Iniciar Sesión</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('rol').addEventListener('change', function() {
            let puesto = document.getElementById('puestoContainer');
            this.value === 'empleado' ?
                puesto.classList.remove('d-none') :
                puesto.classList.add('d-none');
        });
    </script>

</body>

</html>