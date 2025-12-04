<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bienvenido, Estas Son Tus Credenciales de acceso</title>
</head>

<body>
    <h2>¡Hola {{ $nombre }}!</h2>

    <p>Estamos muy felices de darte la bienvenida al <strong>Taller Mecánico</strong>. Tu cuenta ha sido creada exitosamente y ya puedes acceder a nuestro sistema para gestionar tus servicios y comunicarte con nosotros de manera más rápida y sencilla.</p>

    <p>A continuación te compartimos tus credenciales de acceso:</p>

    <p><strong>Correo:</strong> {{ $correo }}</p>
    <p><strong>Contraseña:</strong> {{ $password }}</p>

    <br>
    <p>Gracias por confiar en nosotros,</p>
    <p><strong>Tu Taller Mecánico de Confianza</strong></p>
</body>

</html>