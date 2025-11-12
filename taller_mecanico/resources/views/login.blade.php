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

        .form-control::placeholder {
            color: #6c757d;
        }

        .btn-login {
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .btn-regresar {
            background-color: white;
            color: #007bff;
            border: 2px solid #007bff;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-regresar:hover {
            background-color: #007bff;
            color: white;
        }

        .link {
            color: #007bff;
            font-size: 0.9rem;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border: 2px solid #007bff;
            background-color: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease-in-out;
        }

        .social-btn:hover {
            transform: scale(1.1);
        }

        .social-btn img {
            width: 22px;
            height: 22px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="text-center mb-4">Iniciar Sesión</h3>
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" placeholder="ejemplo@correo.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="********">
            </div>
            <div class="mb-3 text-end">
                <a href="#" class="link text-decoration-none">Olvidaste tu Contraseña click aquí</a>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-login">Ingresar</button>
                <a href="{{ route('registro') }}" class="btn btn-regresar text-center">Regresar</a>
            </div>
            <div class="text-center mt-3">
                <p class="fw-semibold mb-3">o inicia sesión con:</p>
                <div class="d-flex justify-content-center gap-3">
                    <button type="button" class="social-btn">
                        <img src="/images/gmail-icon.png" alt="Gmail">
                    </button>
                    <button type="button" class="social-btn">
                        <img src="/images/facebook-icon.png" alt="Facebook">
                    </button>
                    <button type="button" class="social-btn">
                        <img src="/images/twitter-icon.png" alt="Twitter">
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>