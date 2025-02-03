@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>{{ __('Verifica tu Dirección de Correo Electrónico') }}</h2>
                </div>

                <div class="card-body text-center">
                    @if (session('resent'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: '¡Correo enviado!',
                                text: 'Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <p class="mb-3">
                        {{ __('Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.') }}
                    </p>
                    
                    <p class="mb-4">
                        {{ __('Si no recibiste el correo electrónico') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" id="resendForm">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline resend-btn">
                                {{ __('haz clic aquí para solicitar otro') }}
                            </button>.
                        </form>
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3">
                        <i class="bi bi-house-door"></i> Volver al Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.resend-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Evita el envío inmediato del formulario

        Swal.fire({
            title: '¿Reenviar correo de verificación?',
            text: "Se enviará un nuevo enlace a tu correo.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, reenviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('resendForm').submit(); // Envía el formulario solo si el usuario confirma
            }
        });
    });
});
</script>
@endsection
