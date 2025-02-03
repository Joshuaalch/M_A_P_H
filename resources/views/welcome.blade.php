<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAPH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .login-container {
            text-align: center;
        }
        .btn-login {
            background-color: #444444;/* Azul pastel */
            color: #fff;
            font-size: 1.2rem;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            transition: background-color 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0b5ed7; /* Color más oscuro al pasar el mouse */
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            width: 250px; /* Tamaño de la imagen */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('storage/img/logo1.png') }}" alt="Logo MAPH">
        </div>

        <!-- Botón de Login -->
        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>