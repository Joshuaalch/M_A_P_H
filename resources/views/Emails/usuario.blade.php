<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <p>Hola {{ $usuario->nombre }},</p>
    <p>{!! nl2br(e($messageContent)) !!}</p>
</body>
</html>
