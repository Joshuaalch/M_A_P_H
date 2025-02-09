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
    background: linear-gradient(135deg,rgb(246, 248, 250), rgb(185, 243, 243));
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
    <style>
/* Barra de Navegación */
nav.navbar {
    padding: 0.2rem 1rem;  /* Reduce el padding superior e inferior */
    width: 100%;
    background: linear-gradient(135deg,rgb(202, 246, 252),rgb(161, 228, 240));  /* Cambio aquí */
    color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Contenedor principal */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px; /* Aumenté el padding para un poco más de espacio */
    margin: 0 auto;
}

/* Tarjeta de registro */
.card {
    border: none;
    border-radius: 12px;
    background: #ffffff;
    box-shadow: 0 10px 50px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 1000px; /* Aumenté el valor de max-width */
    padding: 10px; /* Añadí un poco de padding para que no se vean tan pegados los elementos */
    transform: translateY(-50px);
    animation: slideIn 0.8s ease-out forwards;
}

/* Estilo de los campos de entrada */
.form-control {
    width: 100%; /* Esto asegura que los campos ocupen el 100% del espacio disponible */
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 16px; /* Aumenté el padding para hacer los campos más grandes */
    font-size: 1.2rem; /* Aumenté el tamaño de la fuente */
    transition: border-color 0.3s ease;
    box-sizing: border-box; /* Para que el padding no afecte el tamaño del campo*/
}

/* Estilo de la selección */
.form-select {
    width: 100%; /* Las listas desplegables ocupen todo el ancho */
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 16px; /* Aumenté el padding */
    font-size: 1.2rem; /* Aumenté el tamaño de la fuente */
    transition: border-color 0.3s ease;
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Estilo del título del formulario */
.card-header {
    background-color: #fafafa;
    color:rgb(149, 206, 243);  /* Cambio aquí */
    text-align: center;
    padding: 1.5rem;
    font-size: 1.75rem;
    font-weight: bold;
    border-bottom: 2px solid #64b5f6;  /* Cambio aquí */
}

/* Estilo de los campos de entrada */
.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 12px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
    box-sizing: border-box;
}

.form-control:focus {
    border-color: #00bcd4;
    outline: none;
    box-shadow: 0 0 10px rgba(0, 188, 212, 0.4);
}

/* Estilo de la selección */
.form-select {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 12px;
    transition: border-color 0.3s ease;
}

.form-select:focus {
    border-color: #00bcd4;
    outline: none;
    box-shadow: 0 0 10px rgba(0, 188, 212, 0.4);
}

/* Botón primario (Guardar) */
.btn-primary {
    background: linear-gradient(135deg, #64b5f6, #00bcd4);  /* Cambio aquí */
    border: none;
    border-radius: 25px;
    padding: 12px 20px;
    font-size: 1.1rem;
    font-weight: bold;
    color: white;
    display: inline-block; /* Asegura que los botones se comporten como elementos en línea */
    width: auto; /* Desactiva el ancho automático */
    margin-right: 10px; /* Para separar los botones si es necesario */
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #00796b, #64b5f6);  /* Cambio aquí */
    transform: scale(1.05);
}

/* Botón de volver */
.btn-outline-secondary {
    border: 2px solid #64b5f6;  /* Cambio aquí */
    color: #64b5f6;  /* Cambio aquí */
    border-radius: 25px;
    padding: 12px 20px;
    font-size: 1.1rem;
    display: inline-block; /* Asegura que los botones se comporten como elementos en línea */
    width: auto; /* Desactiva el ancho automático */
    margin-left: 10px; /* Para separar los botones si es necesario */
    transition: background-color 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #64b5f6;  /* Cambio aquí */
    color: #ffffff;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 576px) {
    .btn-primary, .btn-outline-secondary {
        font-size: 1rem;
        width: 100%; /* Los botones ocuparán el 100% del ancho en pantallas pequeñas */
        margin: 0; /* Elimina márgenes en pantallas pequeñas para evitar desbordamientos */
    }

/* Estilo para enlaces */
a {
    color: #64b5f6;  /* Cambio aquí */
    text-decoration: none;
    font-size: 1rem;
    display: block;
    margin-top: 1rem;
    text-align: center;
    transition: color 0.3s ease;
}

a:hover {
    color: #00bcd4;
    text-decoration: underline;
}

/* Estilo de los mensajes de error */
.invalid-feedback {
    font-size: 0.9rem;
    color: #d9534f;
}

/* Ajustes para pantallas pequeñas */
@media (max-width: 576px) {
    .card-body {
        padding: 2rem;
    }
    .btn-primary {
        font-size: 1rem;
    }
    .btn-outline-secondary {
        font-size: 1rem;
    }
    .card-header {
        font-size: 1.5rem;
    }
}

    </style>

      <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="fw-bold">Crear Usuario</h2>
                    </div>
                    <div class="card-body">
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
                                    <input type="text" name="id_cedula" id="id_cedula" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="tipo_cedula" class="form-label fw-semibold">Tipo de Cédula</label>
                                    <input type="text" name="tipo_cedula" id="tipo_cedula" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="id_empresa" class="form-label fw-semibold">Empresa</label>
                                <select name="id_empresa" id="id_empresa" class="form-select" required>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id_empresa }}">{{ $empresa->nombre_empresa }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="nombre" class="form-label fw-semibold">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="apellidos" class="form-label fw-semibold">Apellidos</label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label for="correo" class="form-label fw-semibold">Correo</label>
                                <input type="email" name="correo" id="correo" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label for="contrasena" class="form-label fw-semibold">Contraseña</label>
                                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="rol" class="form-label fw-semibold">Rol</label>
                                    <input type="text" name="rol" id="rol" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="estado" class="form-label fw-semibold">Estado</label>
                                    <select id="estado" class="form-select" name="estado" required>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver</a>
                                <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
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
            document.getElementById('crearUsuarioForm').addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: '¿Registrar este usuario?',
                    text: "Asegúrate de que los datos son correctos",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, guardar',
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
