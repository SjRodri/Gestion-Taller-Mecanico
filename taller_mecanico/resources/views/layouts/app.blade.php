<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Taller</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons (opcional pero recomendado) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            height: 100vh;
            background: #212529;
            color: white;
            position: fixed;
            left: 0;
            top: 56px;
            padding: 20px 0;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #bdbdbd;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #343a40;
            color: #fff;
        }

        /* Main content */
        .main-content {
            margin-left: 230px;
            padding: 20px;
            margin-top: 56px;
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- NAVBAR SUPERIOR -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Gestión Taller</a>

            <div class="d-flex">
                <a href="#" class="nav-link text-white">
                    <i class="fa-solid fa-user"></i> Usuario
                </a>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="/empleados"><i class="fa-solid fa-users"></i> Empleados</a>
        <a href="#"><i class="fa-solid fa-car"></i> Vehículos</a>
        <a href="#"><i class="fa-solid fa-screwdriver-wrench"></i> Servicios</a>
        <a href="#"><i class="fa-solid fa-warehouse"></i> Talleres</a>
        <a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Facturación</a>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
