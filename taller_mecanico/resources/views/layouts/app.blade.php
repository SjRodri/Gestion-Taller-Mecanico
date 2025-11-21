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
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1f1f1f;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

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
            padding: 12px 25px;
            color: #cfcfcf;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar .title {
            font-size: 14px;
            font-weight: bold;
            color: #bbbbbb;
            text-transform: uppercase;
            padding: 10px 25px;
            margin-top: 15px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #333;
            color: #ffffff;
        }

        /* Main panel */
        .main-content {
            margin-left: 250px;
            padding: 25px;
        }

        .page-header {
            font-size: 22px;
            font-weight: bold;
            color: #2a2a2a;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="profile">
            <div class="avatar">S</div>
            <p style="font-size:14px; margin:5px 0; font-weight:bold;">example</p>
            <p style="font-size:12px; color:#bbbbbb;">example@gmail.com</p>
        </div>

        <div class="title">Navegación Principal</div>
        <a href="#"><i class="fa-solid fa-house me-2"></i> Inicio</a>
        <a href="/clientes"><i class="fa-solid fa-user me-2"></i> Clientes</a>
        <a href="#"><i class="fa-solid fa-warehouse me-2"></i> Gestión de Talleres</a>
        <a href="/empleados" class="active"><i class="fa-solid fa-users me-2"></i> Empleados</a>
        <a href="#"><i class="fa-solid fa-chart-pie me-2"></i> Reportes</a>
        <a href="#"><i class="fa-solid fa-gear me-2"></i> Configuración</a>
    </div>

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="page-header">@yield('page-title')</div>

        <!-- Controles: Solo se muestran en INDEX -->
        @if (request()->routeIs('empleados.index'))
        <div class="d-flex justify-content-between align-items-center mb-3">

            <form method="GET" action="{{ route('empleados.index') }}" class="d-flex gap-2">

                <input type="text" name="buscar" value="{{ request('buscar') }}"
                    class="form-control" placeholder="Buscar empleado...">

                <select name="rol" class="form-select">
                    <option value="">Rol</option>
                    <option value="Administrador" {{ request('rol') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="Mecánico" {{ request('rol') == 'Mecánico' ? 'selected' : '' }}>Mecánico</option>
                    <option value="Recepción" {{ request('rol') == 'Recepción' ? 'selected' : '' }}>Recepción</option>
                </select>

                <select name="activo" class="form-select">
                    <option value="">Activo</option>
                    <option value="1" {{ request('activo') === '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ request('activo') === '0' ? 'selected' : '' }}>No</option>
                </select>

                <button class="btn btn-outline-secondary"><i class="fa-solid fa-filter"></i></button>
            </form>

            <button class="btn btn-outline-success"
                onclick="window.location='{{ route('empleados.create') }}'">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        @endif

        @yield('content')
    </div>

</body>

</html>