<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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
            border: 2px solid #9A0D1B;
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

        .btn-login {
            background-color: #9A0D1B;
            color: white;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #e74353ff;
        }

        .btn-regresar {
            background-color: white;
            color: #9A0D1B;
            border: 2px solid #9A0D1B;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-regresar:hover {
            background-color: #e74353ff;
            color: white;
        }

        .link {
            color: #9A0D1B;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="card">

        <h3 class="text-center mb-4">Iniciar Sesión</h3>

        {{-- Mensajes flash --}}
        @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" name="email" class="form-control" id="email"
                    placeholder="ejemplo@correo.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="********" required>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-login">Ingresar</button>
                <a href="{{ url('registro') }}" class="btn btn-regresar text-center">Registrarse</a>
            </div>
        </form>

    </div>
</body>

</html>