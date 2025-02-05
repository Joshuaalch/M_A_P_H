@extends('layouts.app')
<style>
/* Barra de Navegación */
nav.navbar {
    padding: 0.2rem 0.2rem; 
    width: 100%; /* Asegura que ocupe todo el ancho */
    box-sizing: border-box;
    background: linear-gradient(135deg, rgb(190, 223, 247), rgb(255, 255, 255));
    color: #000;
}

/* Contenedor principal */
.container {
    position: relative;
    left: 50%; /* Mueve el contenedor al 50% desde la izquierda */
    transform: translateX(-50%); /* Centra el contenedor */
    min-height: 10vh;
    color: #000000;
}

/* Tarjeta de registro */
.card {
    border: none;
    border-radius: 15px;
    background: linear-gradient(135deg, #bbdefb, rgb(185, 243, 243));
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

/* Estilo base para todos los botones */
button, .btn {
    width: 48%; /* Hace que los botones ocupen un 48% del contenedor, asegurando que tengan el mismo tamaño */
    padding: 12px; /* Ajuste de padding para consistencia */
    font-size: 1rem; /* Tamaño de fuente consistente */
    border-radius: 25px;
    font-weight: bold;
    transition: transform 0.3s ease;
    display: inline-block; /* Asegura que los botones se vean correctamente */
    margin: 0.5rem; /* Añade un poco de espacio entre los botones */
}

/* Botón de acción (Guardar y Volver) */
.btn-primary, .btn-secondary {
    background: linear-gradient(135deg, rgb(113, 192, 245), rgb(253, 132, 199)); /* Mismo color */
    border: none;
    color: white;
}

.btn-primary:hover, .btn-secondary:hover {
    background: linear-gradient(135deg, rgb(248, 84, 185), rgb(174, 234, 241)); /* Mismo color hover */
    transform: scale(1.05);
}

/* Estilo para enlaces */
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

/* Ajustes para pantallas pequeñas */
@media (max-width: 576px) {
    .container {
        left: 0; /* En pantallas pequeñas, mueve el formulario a la izquierda */
        transform: translateX(0); /* Elimina el desplazamiento horizontal */
    }
    .card-body {
        padding: 1.5rem;
    }
    .btn-primary, .btn-secondary {
        font-size: 1rem;
    }
}
</style>

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Crear Usuario</h2>
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

                    <form action="{{ route('usuarios.store') }}" method="POST" id="crearUsuarioForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="id_cedula" class="form-label fw-semibold">Cédula</label>
                                <input type="text" name="id_cedula" id="id_cedula" class="form-control p-3 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tipo_cedula" class="form-label fw-semibold">Tipo de Cédula</label>
                                <input type="text" name="tipo_cedula" id="tipo_cedula" class="form-control p-3 shadow-sm" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="id_empresa" class="form-label fw-semibold">Empresa</label>
                            <select name="id_empresa" id="id_empresa" class="form-select p-3 shadow-sm" required>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombre_empresa }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="nombre" class="form-label fw-semibold">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control p-3 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="apellidos" class="form-label fw-semibold">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control p-3 shadow-sm" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control p-3 shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="form-label fw-semibold">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-control p-3 shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="contrasena" class="form-label fw-semibold">Contraseña</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control p-3 shadow-sm" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="rol" class="form-label fw-semibold">Rol</label>
                                <input type="text" name="rol" id="rol" class="form-control p-3 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="estado" class="form-label fw-semibold">Estado</label>
                                <select id="estado" class="form-select p-3 shadow-sm" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-lg btn-primary shadow-sm fw-bold px-4 py-2">Volver</a>
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold px-4 py-2">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
