<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MAPH') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

   @vite(['resources/sass/app.scss', 'resources/js/app.js'])
   @stack('styles')

</head>
<body>
    <div id="app">
        <!-- Barra de Navegación -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logo o Nombre de la Aplicación -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'MAPH') }}
                </a>

                <!-- Botón para Menú en Dispositivos Móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del Menú -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Lado Izquierdo del Menú -->
                    <ul class="navbar-nav me-auto">
                        <!-- Puedes agregar enlaces adicionales aquí -->
                    </ul>

                    <!-- Lado Derecho del Menú -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Enlaces de Autenticación -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <!-- Menú Desplegable del Usuario -->
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a
    href="{{ route('profile.edit') }}"
    class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600"
>
    Editar Perfil
</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                   

                                    <!-- Formulario de Cierre de Sesión -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido Principal -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>