<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page Title: The subject of the message is dynamically set here -->
    <title>{{ $subject }}</title>
</head>
<body>
    <!-- Main Heading: Important message title -->
    <h1>Mensaje Importante</h1>
    
    <!-- Message Content: The body of the message is dynamically displayed -->
    <p>{{ $message }}</p>
    
    <!-- Closing: Thank you note -->
    <p>Gracias,</p>
    
    <!-- Signature: The name of the application is dynamically retrieved from the configuration -->
    <p>El equipo de {{ config('app.name') }}</p>
</body>
</html>
