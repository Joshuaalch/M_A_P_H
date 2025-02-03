@extends('layouts.app')
@push('styles')
<style>
    /* Barra de Navegación */
    nav.navbar {
        padding: 0.2rem 0.2rem; 
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        box-sizing: border-box;
        background-color: #2c3e50; /* Fondo oscuro */
        background: linear-gradient(135deg, #e3f2fd, #bbdefb); /* Fondo degradado celeste pastel */
        color: #000;
    }

    .navbar-nav {
        display: flex;
        justify-content: space-between;
        background: linear-gradient(135deg, #bbdefb, #90caf9); /* Fondo degradado celeste */
        color: #000;
    }

    .navbar-toggler {
        padding: 0.25rem 0.5rem;
        font-size: 1rem;
        background: linear-gradient(135deg, #e3f2fd, #64b5f6); /* Fondo degradado celeste */
        color: #000;
    }

    /* Fondo y contenedor principal */
    .container {
        justify-content: center;
        align-items: center;
        min-height: 10vh;
        color: #000;
    }

    /* Tarjeta de login */
    .card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #bbdefb,rgb(185, 243, 243)); /* Fondo claro */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-100px);
        animation: slideIn 0.8s ease forwards;
        width: 100%;
        max-width: 400px;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        color:rgb(252, 147, 212); /* Azul profesional */
        text-align: center;
        font-size: 2rem;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }

    /* Estilo de los inputs */
    .form-control {
        border-radius: 10px;
        border: 1px solid #2980b9;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 10px rgba(41, 128, 185, 0.5);
        border-color: #1e88e5;
    }

    .form-control:invalid {
        border-color:rgb(248, 165, 204);
    }

    /* Estilo del botón */
    .btn-primary {
        background: linear-gradient(135deg, #90caf9,rgb(241, 165, 207));
        border: none;
        border-radius: 25px;
        padding: 10px;
        font-size: 1.1rem;
        font-weight: bold;
        letter-spacing: 1px;
        transition: transform 0.3s ease;
        width: 100%;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #64b5f6,rgb(174, 234, 241));
        transform: scale(1.05);
    }

    /* Enlace de recuperación */
    a {
        color:rgb(245, 95, 120);
        text-decoration: none;
        transition: color 0.3s ease;
        text-align: center;
        display: block;
        margin-top: 1rem;
    }

    a:hover {
        text-decoration: underline;
        color: #64b5f6;
    }

    /* Adaptabilidad en pantallas pequeñas */
    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }
</style>
@endpush

<!-- Finaliza el estilo -->
@endpush

@section('content')
<div class="container custom-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Restablecer Contraseña') }}
                </div>

                <div class="card-body custom-card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Token Oculto -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Campo de Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Ingresa tu correo electrónico">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Ingresa tu nueva contraseña">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Confirmar Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmar Nueva Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control custom-form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirma tu nueva contraseña">
                        </div>

                        <!-- Botón de Restablecer Contraseña -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary custom-btn-primary">
                                {{ __('Restablecer Contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
