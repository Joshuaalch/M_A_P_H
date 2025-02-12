<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title> <!-- The subject of the email, dynamically set -->
</head>
<body>
    <p>Hola {{ $usuario->nombre }},</p> <!-- Greeting the user by their name -->
    
    <!-- Displaying the message content with line breaks properly handled -->
    <p>{!! nl2br(e($messageContent)) !!}</p> <!-- nl2br converts newlines to <br> tags, and e() escapes any HTML content for security -->
</body>
</html>
