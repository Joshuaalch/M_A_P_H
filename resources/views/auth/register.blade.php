@extends('layouts.app') <!-- Asegúrate de que este layout exista -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>{{ __('Registro') }}</h2>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro Exitoso',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="registroForm">
                        @csrf

                        <!-- Campo de Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                   placeholder="Ingresa tu nombre">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="Ingresa tu correo electrónico">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Ingresa tu contraseña">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Confirmación de Contraseña -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirma tu contraseña">
                        </div>

                        <!-- Botón de Registro -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="registroBtn">
                                {{ __('Registrarse') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('registroForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Evita el envío inmediato del formulario

        Swal.fire({
            title: '¿Confirmar Registro?',
            text: "Asegúrate de que los datos ingresados son correctos.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrarme',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Envía el formulario solo si el usuario confirma
            }
        });
    });
});
</script>

@push('styles')
<style>
    /* Barra de Navegación */
    nav.navbar {
        padding: 0.2rem 0.2rem; 
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        box-sizing: border-box;
        background: linear-gradient(135deg, #e3f2fd, #bbdefb); /* Fondo degradado celeste pastel */
        color: #000;
    }

    /* Contenedor principal */
    .container {
        justify-content: center;
        align-items: center;
        min-height: 10vh;
        color: #000;
        margin-left: 190px;  /* Ajusta este valor según sea necesario */
    }

    /* Tarjeta de registro */
    .card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #bbdefb, rgb(185, 243, 243)); /* Fondo claro */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-100px);
        animation: slideIn 0.8s ease forwards;
        width: 100%;
        max-width: 550px;
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

    .card-header {
        background-color: #ffffff;
        color: #000000;
        text-align: center;
        padding: 1rem;
        font-size: 1.5rem;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #2980b9;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        box-shadow: 0 0 10px rgba(41, 128, 185, 0.5);
        border-color: #1e88e5;
    }

    .btn-primary {
        background: linear-gradient(135deg, rgb(113, 192, 245), rgb(253, 132, 199));
        border: none;
        border-radius: 25px;
        padding: 10px;
        font-size: 1.1rem;
        font-weight: bold;
        transition: transform 0.3s ease;
        width: 100%;
        color: rgb(255, 255, 255);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, rgb(248, 84, 185), rgb(174, 234, 241));
        transform: scale(1.05);
    }

    a {
        color: rgb(245, 95, 120);
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

    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }
</style>
@endpush
