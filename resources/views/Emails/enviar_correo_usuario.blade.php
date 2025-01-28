<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
</head>
<body>
    <h1>Mensaje Importante</h1>
    <p>{{ $message }}</p>
    <p>Gracias,</p>
    <p>El equipo de {{ config('app.name') }}</p>
</body>
</html>