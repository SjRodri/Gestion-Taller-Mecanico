<!doctype html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <h2>Nuevo registro de empleado pendiente</h2>

    <p>Se ha registrado un nuevo usuario con rol <strong>empleado</strong> que requiere aprobación.</p>

    <p><strong>Correo:</strong> {{ $user->email }}</p>
    @if(!empty($puesto))
    <p><strong>Puesto solicitado:</strong> {{ $puesto }}</p>
    @endif

    <p>Acciones disponibles:</p>
    <ul>
        <li>Ir al panel de administración y revisar la cuenta.</li>
        <li>Aprobar la cuenta (establecer <code>activo = 1</code>) si corresponde.</li>
    </ul>

    <p>Usuario ID: {{ $user->usuario_id ?? $user->id ?? 'N/A' }}</p>

    <p>Saludos,<br>Gestión de Talleres</p>
</body>

</html>