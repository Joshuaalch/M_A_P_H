@extends('layouts.app')
<style>
/* Barra de Navegación */
nav.navbar {
    padding: 0.2rem 0.2rem;
    width: 100%;
    box-sizing: border-box;
    background: linear-gradient(135deg, rgb(190, 223, 247), rgb(255, 255, 255));
    color: #000;
}

/* Contenedor principal */
.container {
    position: relative;
    left: 50%; /* Mover el contenedor al 50% de la pantalla */
    transform: translateX(-50%); /* Ajuste para centrar completamente */
    min-height: 10vh;
    color: #000000;
    padding-right: 20px; /* Para evitar el desbordamiento */
}

/* Tarjeta de registro */
.card {
    border: none;
    border-radius: 15px;
    background: linear-gradient(135deg,rgb(246, 248, 250), rgb(185, 243, 243));
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    transform: translateY(-100px);
    animation: slideIn 0.8s ease forwards;
    width: 100%;
    max-width: 480px;
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

/* Estilo del título del formulario */
.card-header {
    background-color: rgb(248, 167, 198); /* Fondo de la cabecera */
    color: rgb(248, 167, 198);
    text-align: center;
    padding: 1rem;
    font-size: 1.5rem;
    font-weight: bold;
}

.card-header h2 {
    color:rgb(245, 132, 220); /* Cambia el color del texto del título específicamente */
}

/* Estilo de los campos de entrada */
.form-control {
    border-radius: 10px;
    border: 1px solid #2980b9;
    transition: border-color 0.3s ease;
    padding: 12px;
}

.form-control:focus {
    box-shadow: 0 0 10px rgba(41, 128, 185, 0.5);
    border-color: #1e88e5;
}

/* Estilo para select */
.form-select {
    border-radius: 10px;
    border: 1px solid #2980b9;
    transition: border-color 0.3s ease;
    padding: 12px;
}

.form-select:focus {
    box-shadow: 0 0 10px rgba(41, 128, 185, 0.5);
    border-color: #1e88e5;
}

/* Botón común */
.btn-common {
    background: linear-gradient(135deg, rgb(113, 192, 245), rgb(253, 132, 199));
    border: none;
    border-radius: 25px;
    padding: 10px;
    font-size: 1.1rem;
    font-weight: bold;
    transition: transform 0.3s ease;
    width: 100%;
    color: white;
    text-align: center;
}

.btn-common:hover {
    background: linear-gradient(135deg, rgb(248, 84, 185), rgb(174, 234, 241));
    transform: scale(1.05);
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 576px) {
    .card-body {
        padding: 1.5rem;
    }
    .btn-common {
        font-size: 1rem;
    }
    .container {
        left: 0;
        transform: translateX(0); /* Sin desplazamiento en pantallas pequeñas */
        padding-right: 0;
    }
}
</style>
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Editar Perfil</h2>
                </div>
                
                <div class="card-body p-5">
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" id="editarPerfilForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input id="name" type="text" class="form-control p-3 shadow-sm @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required placeholder="Ingresa tu nombre">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control p-3 shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required placeholder="Ingresa tu correo electrónico">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Nueva Contraseña (opcional)</label>
                            <input id="password" type="password" class="form-control p-3 shadow-sm @error('password') is-invalid @enderror" name="password" placeholder="Ingresa tu nueva contraseña">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">Confirmar Nueva Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control p-3 shadow-sm" name="password_confirmation" placeholder="Confirma tu nueva contraseña">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="guardarBtn">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editarPerfilForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Guardar cambios en el perfil?',
            text: "Asegúrate de que la información es correcta",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actualizar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@endsection