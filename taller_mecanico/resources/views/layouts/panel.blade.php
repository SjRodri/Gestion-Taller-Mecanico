<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Taller')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #e7e7e7ff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #0d0d0d;
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            padding-bottom: 40px; /* ← ESPACIO PARA EL BOTÓN */
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.25);
            overflow-y: auto;
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #6A040F;
            border-radius: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #8a0615;
        }

        /* Perfil del usuario */
        .sidebar .profile {
            text-align: center;
            margin-bottom: 25px;
            padding: 0 15px;
        }

        .profile .avatar {
            width: 70px;
            height: 70px;
            background: #6A040F;
            color: #fff;
            font-size: 30px;
            border-radius: 50%;
            margin: 10px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(248, 248, 248, 0.15);
        }

        .sidebar a {
            display: block;
            padding: 10px 22px;
            color: #ffffffff;
            text-decoration: none;
            font-size: 15px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #6A040F;
            color: #fff;
            padding-left: 28px;
        }

        .sidebar .title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 12px 20px;
            margin-top: 20px;
            color: #ffffffff;
        }

        /* CONTENIDO */
        .main-content {
            margin-left: 250px;
            padding: 35px;
            min-height: 100vh;
        }

        /* TÍTULO DEL HEADERSHH */
        .page-header {
            width: 100%;
            background: #9A0D1B;
            padding: 18px 30px;
            border-radius: 10px;
            color: #fff;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="profile">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <p style="font-size:15px; margin:5px 0; font-weight:bold;">
                {{ auth()->user()->name }}
            </p>

            <p style="font-size:13px; color:#cecece;">
                {{ auth()->user()->email }}
            </p>
        </div>

        <div class="title">Navegación Principal</div>

        <a href="/home"><i class="fa-solid fa-house me-2"></i> Inicio</a>

        @if(auth()->user()->rol == 'admin')
            <a href="/clientes"><i class="fa-solid fa-user me-2"></i> Clientes</a>
            <a href="/empleados"><i class="fa-solid fa-users me-2"></i> Empleados</a>
            <a href="/vehiculos"><i class="fa-solid fa-car me-2"></i> Vehículos</a>
            <a href="/repuestos"><i class="fa-solid fa-box me-2"></i> Repuestos</a>
            <a href="/ordenes"><i class="fa-solid fa-list me-2"></i> Órdenes</a>
            <a href="/talleres"><i class="fa-solid fa-warehouse me-2"></i> Talleres</a>
            <a href="/mapa"><i class="fa-solid fa-map me-2"></i> Mapa</a>
            <a href="/reportes"><i class="fa-solid fa-chart-pie me-2"></i> Reportes</a>
        @endif

        @if(auth()->user()->rol == 'empleado')
            <a href="/repuestos"><i class="fa-solid fa-box me-2"></i> Repuestos</a>
            <a href="/ordenes"><i class="fa-solid fa-list me-2"></i> Órdenes</a>
            <a href="/vehiculos"><i class="fa-solid fa-car me-2"></i> Vehículos</a>
            <a href="/mapa"><i class="fa-solid fa-map me-2"></i> Mapa</a>
            <a href="/configuracion"><i class="fa-solid fa-gear me-2"></i> Configuración</a>
        @endif

        @if(auth()->user()->rol == 'cliente')
            <a href="/ordenes"><i class="fa-solid fa-calendar me-2"></i> Citas</a>
            <a href="/mapa"><i class="fa-solid fa-map me-2"></i> Talleres</a>
            <a href="/configuracion"><i class="fa-solid fa-gear me-2"></i> Configuración</a>
        @endif

        <!-- BOTÓN CERRAR SESIÓN -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4 px-3 mb-4">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="fa-solid fa-door-open me-2"></i> Cerrar sesión
            </button>
        </form>

    </div>

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="page-header">@yield('page-title')</div>
        @yield('content')
    </div>

</body>

</html>

