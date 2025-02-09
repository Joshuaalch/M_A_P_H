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
            background: linear-gradient(135deg, #007bff, #6610f2);
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        .btn-login {
            background-color: #007bff;
            color: #fff;
            font-size: 1.2rem;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-login:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .logo {
            margin-bottom: 20px;
        }
        .logo img {
            width: 200px;
            height: auto;
            transition: transform 0.3s ease;
        }
        .logo img:hover {
            transform: rotate(5deg) scale(1.1);
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
        <a href="{{ route('login') }}" class="btn btn-login">Ingresar</a>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>