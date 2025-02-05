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

/* Botón primario */
.btn-primary {
    background: linear-gradient(135deg, rgb(113, 192, 245), rgb(253, 132, 199));
    border: none;
    border-radius: 25px;
    padding: 10px;
    font-size: 1.1rem;
    font-weight: bold;
    transition: transform 0.3s ease;
    width: 100%;
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, rgb(248, 84, 185), rgb(174, 234, 241));
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
    .btn-primary {
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
                    <h2 class="fw-bold">Crear nueva empresa </h2>
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

                    <form action="{{ route('empresas.store') }}" method="POST" id="empresaForm">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-semibold">Nombre de la Empresa</label>
                            <input id="nombre" type="text" class="form-control p-3 shadow-sm @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required placeholder="Ejemplo S.A.">
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="cedula" class="form-label fw-semibold">Cédula</label>
                                <input id="cedula" type="text" class="form-control p-3 shadow-sm @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required placeholder="Ingrese la cédula">
                                @error('cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tipo_cedula" class="form-label fw-semibold">Tipo de Cédula</label>
                                <input id="tipo_cedula" type="text" class="form-control p-3 shadow-sm @error('tipo_cedula') is-invalid @enderror" name="tipo_cedula" value="{{ old('tipo_cedula') }}" required>
                                @error('tipo_cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                                <input id="telefono" type="text" class="form-control p-3 shadow-sm @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>
                                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                                <input id="correo" type="email" class="form-control p-3 shadow-sm @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required>
                                @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="form-label fw-semibold">Estado</label>
                            <select id="estado" class="form-select p-3 shadow-sm @error('estado') is-invalid @enderror" name="estado" required>
                                <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="guardarBtn">Guardar Empresa</button>
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
    document.getElementById('empresaForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Guardar esta empresa?',
            text: "Verifica que los datos sean correctos antes de confirmar.",
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
