@extends('layouts.app')
<<<<<<< Updated upstream
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
=======
>>>>>>> Stashed changes

@push('styles')
    @vite(['resources/css/userEdit.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Editar Usuario</h2>
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

                    <form action="{{ route('usuarios.update', $usuario->id_cedula) }}" method="POST" id="editarUsuarioForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="id_cedula" class="form-label fw-semibold">Cédula</label>
                            <input type="text" name="id_cedula" id="id_cedula" class="form-control p-3 shadow-sm" value="{{ $usuario->id_cedula }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="tipo_cedula" class="form-label fw-semibold">Tipo de Cédula</label>
                            <input type="text" name="tipo_cedula" id="tipo_cedula" class="form-control p-3 shadow-sm" value="{{ $usuario->tipo_cedula }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="id_empresa" class="form-label fw-semibold">Empresa</label>
                            <select name="id_empresa" id="id_empresa" class="form-select p-3 shadow-sm" required>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id_empresa }}" {{ $usuario->id_empresa == $empresa->id_empresa ? 'selected' : '' }}>
                                        {{ $empresa->nombre_empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control p-3 shadow-sm" value="{{ $usuario->nombre }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="apellidos" class="form-label fw-semibold">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control p-3 shadow-sm" value="{{ $usuario->apellidos }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control p-3 shadow-sm" value="{{ $usuario->telefono }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="form-label fw-semibold">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-control p-3 shadow-sm" value="{{ $usuario->correo }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="contrasena" class="form-label fw-semibold">Contraseña (opcional)</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control p-3 shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label for="rol" class="form-label fw-semibold">Rol</label>
                            <input type="text" name="rol" id="rol" class="form-control p-3 shadow-sm" value="{{ $usuario->rol }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="form-label fw-semibold">Estado</label>
                            <select id="estado" class="form-select p-3 shadow-sm" name="estado" required>
                                <option value="Activo" {{ $usuario->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ $usuario->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-common shadow-sm px-4 py-2">Volver</a>
                            <button type="submit" class="btn btn-common btn-lg shadow-sm fw-bold px-4 py-2" id="actualizarBtn">Actualizar</button>
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
    document.getElementById('editarUsuarioForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Guardar cambios en el usuario?',
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
