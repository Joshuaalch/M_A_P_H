<!DOCTYPE html>
<html lang="en">

<head>
    <title>MAPH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('storage/img/apple-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('storage/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/css/custom.css') }}">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('storage/css/fontawesome.min.css') }}">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
            <img src="{{ asset('storage/img/logo1.png') }}" alt="Logo MAPH" style="width: 100px; height: auto;">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="main_nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Bandeja De Soporte</a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            <div class="nav-item dropdown me-3">
                <a class="nav-icon position-relative text-decoration-none d-flex align-items-center justify-content-center" href="#" id="notificationDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-bell text-dark"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">Nueva solicitud recibida</a>
                </div>
            </div>
            
            <div class="nav-item dropdown">
                <a class="nav-icon position-relative text-decoration-none d-flex align-items-center justify-content-center" href="#" id="profileDropdown" data-bs-toggle="dropdown">
                    @auth
                        <span class="text-dark">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    @else
                        <i class="fa fa-user text-dark"></i>
                    @endauth
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Editar Perfil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
    </div>
</nav>

<section class="bg-light py-5">
    <div class="container text-center">
        <h1 class="mb-4">Funcionalidades</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <a href="{{ url('/solicitudes') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4">
                        <i class="fas fa-clipboard-list fa-2x mb-3 text-success"></i>
                        <h3 class="text-dark">Solicitudes Nuevas</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('/usuarios') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4">
                        <i class="fas fa-users fa-2x mb-3 text-primary"></i>
                        <h3 class="text-dark">Asociados</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ url('/empresas') }}" class="text-decoration-none">
                    <div class="card shadow-sm p-4">
                        <i class="fas fa-building fa-2x mb-3 text-warning"></i>
                        <h3 class="text-dark">Empresas</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<footer class="bg-dark text-light py-4">
    <div class="container text-center">
        <h4 class="text-success">Info</h4>
        <p>Sarapiquí | <a href="tel:88199019" class="text-light">8819-9019</a> | <a href="mailto:soportemaph@gmail.com" class="text-light">soportemaph@gmail.com</a></p>
        <p class="small">MAPH | Diseñado Por Joshua, David, Maizeth</p>
    </div>
</footer>

<script src="{{ asset('storage/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('storage/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('storage/js/templatemo.js') }}"></script>
<script src="{{ asset('storage/js/custom.js') }}"></script>
</body>
</html>
