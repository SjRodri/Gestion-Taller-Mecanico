<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal Administrador</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
        }

        /* --- Barra lateral --- */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            height: 100vh;
            background-color: #222;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 18px;
            padding: 15px 0;
            background-color: #111;
            margin: 0;
        }

        .sidebar .perfil {
            text-align: center;
            padding: 15px;
        }

        .sidebar .perfil .foto {
            width: 60px;
            height: 60px;
            background-color: #444;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 10px;
        }

        .sidebar .perfil p {
            font-size: 13px;
            margin: 4px 0;
        }

        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links li {
            border-top: 1px solid #333;
        }

        .nav-links a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
        }

        .nav-links a:hover,
        .nav-links .active {
            background-color: #444;
        }

        .logout {
            padding: 15px;
            text-align: center;
            border-top: 1px solid #333;
        }

        .logout a {
            color: #fff;
            text-decoration: none;
        }

        /* --- Contenido principal --- */
        .main-content {
            margin-left: 220px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
        }

        .header .fecha {
            font-size: 12px;
            color: #777;
        }

        /* --- Tarjetas --- */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .card {
            background-color: #ddd;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s;
        }

        .card:hover {
            background-color: #ccc;
        }

        .card-icon {
            font-size: 36px;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div>
            <h2>Gestión de Talleres 🚗</h2>

            <div class="perfil">
                <div class="foto"></div>
                <p><strong>Sayd Josue Rodríguez M.</strong></p>
                <p>example@gmail.com</p>
            </div>

            <ul class="nav-links">
                <li><a href="#" class="active">🏠 Inicio</a></li>
                <li><a href="{{ url('/clientes') }}">👥 Clientes</a></li>
                <li><a href="#">🧰 Gestión de Talleres</a></li>
                <li><a href="#">👨‍🔧 Empleados</a></li>
                <li><a href="#">📊 Reportes</a></li>
                <li><a href="#">🔧 Repuestos</a></li>
                <li><a href="#">⚙️ Configuración</a></li>
            </ul>
        </div>

        <div class="logout">
            <a href="#">🚪 Cerrar Sesión</a>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Bienvenido otra vez, Sayd Admin.</h1>
            <p class="fecha">Fecha y hora actual</p>
        </div>

        <div class="cards">
            <div class="card">
                <span class="card-icon">👥</span>
                <p>Clientes atendidos este mes</p>
            </div>

            <div class="card">
                <span class="card-icon">✔️</span>
                <p>Estado de Órdenes</p>
            </div>

            <div class="card">
                <span class="card-icon">💲</span>
                <p>Ingresos Mensuales</p>
            </div>

            <div class="card">
                <span class="card-icon">⚠️</span>
                <p>Repuestos con bajo stock</p>
            </div>

            <div class="card">
                <span class="card-icon">🕒</span>
                <p>Próximas citas</p>
            </div>

            <div class="card">
                <span class="card-icon">📍</span>
                <p>Mapa de Sucursales</p>
            </div>
        </div>
    </div>

</body>

</html>