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

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('storage/css/fontawesome.min.css') }}">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light shadow py-2">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="index.html">
            <img src="{{ asset('storage/img/logo1.png') }}" alt="Logo MAPH" style="width: 100px; height: auto;">
        </a>

        <!-- Botón de menú para dispositivos móviles -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse justify-content-center" id="templatemo_main_nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Bandeja De Soporte</a>
                </li>
        
            </ul>
        </div>

        <!-- Contenedor de íconos (notificaciones y perfil) -->
        <div class="d-flex align-items-center">
            <!-- Campana de notificaciones -->
            <div class="nav-item dropdown me-3">
                <a class="nav-icon position-relative text-decoration-none d-flex align-items-center justify-content-center" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px; height: 35px; border-radius: 50%; background-color: #f0f0f0;">
                    <i class="fas fa-bell text-dark"></i>
                    <!-- Indicador de notificaciones no leídas -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                        1 <!-- Número de notificaciones no leídas -->
                        <span class="visually-hidden">Notificaciones no leídas</span>
                    </span>
                </a>
                <!-- Menú desplegable de notificaciones -->
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item" href="#">Nueva solicitud recibida</a>
                </div>
            </div>

            <!-- Ícono de perfil -->
            <div class="nav-item dropdown">
                <a class="nav-icon position-relative text-decoration-none d-flex align-items-center justify-content-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 35px; height: 35px; border-radius: 50%; background-color: #f0f0f0;">
                    @auth
                        <span class="text-dark">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    @else
                        <i class="fa fa-fw fa-user text-dark"></i>
                    @endauth
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        Editar Perfil
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
 <!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Funcionalidades</h1>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Centrar las tarjetas horizontalmente -->
            <!-- Tarjeta de Solicitudes -->
            <div class="col-12 col-md-4 mb-4 d-flex justify-content-center"> <!-- Centrar la tarjeta -->
                <a href="{{ url('/solicitudes') }}" class="text-decoration-none" style="width: 100%; max-width: 300px;"> <!-- Limitar el ancho máximo -->
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-clipboard-list fa-2x mb-3 text-success"></i>
                            <p class="h2 text-dark">Solicitudes Nuevas</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Asociados -->
            <div class="col-12 col-md-4 mb-4 d-flex justify-content-center"> <!-- Centrar la tarjeta -->
                <a href="{{ url('/asociados') }}" class="text-decoration-none" style="width: 100%; max-width: 300px;"> <!-- Limitar el ancho máximo -->
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-2x mb-3 text-primary"></i>
                            <p class="h2 text-dark">Asociados</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Empresas -->
            <div class="col-12 col-md-4 mb-4 d-flex justify-content-center"> <!-- Centrar la tarjeta -->
                <a href="{{ url('/empresas') }}" class="text-decoration-none" style="width: 100%; max-width: 300px;"> <!-- Limitar el ancho máximo -->
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-building fa-2x mb-3 text-warning"></i> <!-- Icono de empresa -->
                            <p class="h2 text-dark">Empresas</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End Featured Product -->



    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-2">
                    <h2 class="h4 text-success border-bottom pb-1 border-light logo">Info</h2>
                    <ul class="list-unstyled text-light footer-link-list small">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Sarapiquí
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">8819-9019</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">soportemaph@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row text-light mb-1">
                <div class="col-12 mb-1">
                    <div class="w-100 my-1 border-top border-light"></div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-1">
            <div class="container">
                <div class="row pt-1">
                    <div class="col-12">
                        <p class="text-left text-light small">
                            MAPH
                            | Diseñado Por Joshua, David, Maizeth
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="{{ asset('storage/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('storage/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('storage/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/js/templatemo.js') }}"></script>
    <script src="{{ asset('storage/js/custom.js') }}"></script>
    <!-- End Script -->
</body>
</html>