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
            background: #f5f5f5;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1f1f1f;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            overflow-y: auto;
            /* Evita desbordes */
        }

        /* Perfil */
        .sidebar .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile .avatar {
            width: 60px;
            height: 60px;
            background: #444;
            color: #fff;
            font-size: 24px;
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sidebar a {
            display: block;
            padding: 8px 20px;
            color: #cfcfcf;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar .title {
            font-size: 14px;
            font-weight: bold;
            color: #bbbbbb;
            text-transform: uppercase;
            padding: 10px 20px;
            margin-top: 15px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #333;
            color: #ffffff;
        }

        /* CONTENIDO */
        .main-content {
            margin-left: 250px;
            /* espacio para el sidebar */
            padding: 30px;
            padding-top: 40px;
            /* separa del top */
            min-height: 100vh;
        }

        /* TITULO */
        .page-header {
            font-size: 24px;
            font-weight: bold;
            color: #2a2a2a;
            margin-bottom: 25px;
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

            <p style="font-size:14px; margin:5px 0; font-weight:bold;">
                {{ auth()->user()->name }}
            </p>

            <p style="font-size:12px; color:#bbbbbb;">
                {{ auth()->user()->email }}
            </p>
        </div>

        <div class="title">Navegación Principal</div>

        <!-- MENU SEGÚN ROL -->

        <a href="/home"><i class="fa-solid fa-house me-2"></i> Inicio</a>

        @if(auth()->user()->rol == 'admin')
        <a href="/clientes"><i class="fa-solid fa-user me-2"></i> Clientes</a>
        <a href="/empleados"><i class="fa-solid fa-users me-2"></i> Empleados</a>
        <a href="/repuestos"><i class="fa-solid fa-box me-2"></i> Repuestos</a>
        <a href="/ordenes"><i class="fa-solid fa-list me-2"></i> Órdenes</a>
        <a href="/talleres"><i class="fa-solid fa-warehouse me-2"></i> Talleres</a>
        <a href="/mapa"><i class="fa-solid fa-map me-2"></i> Mapa</a>
        <a href="/reportes"><i class="fa-solid fa-chart-pie me-2"></i> Reportes</a>
        @endif

        @if(auth()->user()->rol == 'empleado')
        <a href="/repuestos"><i class="fa-solid fa-box me-2"></i> Repuestos</a>
        <a href="/ordenes"><i class="fa-solid fa-list me-2"></i> Órdenes</a>
        <a href="/mapa"><i class="fa-solid fa-map me-2"></i> Mapa</a>
        <a href="/configuracion"><i class="fa-solid fa-gear me-2"></i> Configuracion</a>
        @endif

        @if(auth()->user()->rol == 'cliente')
        <a href="/ordenes"><i class="fa-solid fa-calendar me-2"></i> Citas</a>
        <a href="/mapa"><i class="fa-solid fa-map me-2"></i> Talleres</a>
        <a href="/configuracion"><i class="fa-solid fa-gear me-2"></i> Configuracion</a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button class="btn btn-danger w-100">
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