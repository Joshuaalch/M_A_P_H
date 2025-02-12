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
    left: 50%;
    transform: translateX(-50%);
    min-height: 10vh;
    color: #000000;
}

/* Tarjeta de detalles */
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
    background-color: rgb(248, 167, 198);
    color: rgb(248, 167, 198);
    text-align: center;
    padding: 1rem;
    font-size: 1.5rem;
    font-weight: bold;
}

.card-header h2 {
    color: rgb(245, 132, 220);
}

/* Estilo de los párrafos */
.card-body p {
    font-size: 1.2rem;
    margin-bottom: 15px;
}

/* Estilo para los botones */
button, .btn {
    width: 48%;
    padding: 12px;
    font-size: 1rem;
    border-radius: 25px;
    font-weight: bold;
    transition: transform 0.3s ease;
    display: inline-block;
    margin: 0.5rem;
}

/* Botones secundarios y primarios */
.btn-outline-secondary, .btn-outline-primary, .btn-outline-danger {
    padding: 12px 25px;
    border-radius: 25px;
    border: 2px solid #bbdefb;
    color: #000;
    background: transparent;
}

.btn-outline-secondary:hover, .btn-outline-primary:hover, .btn-outline-danger:hover {
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
        left: 0;
        transform: translateX(0);
    }
    .card-body {
        padding: 1.5rem;
    }
    .btn-outline-secondary, .btn-outline-primary, .btn-outline-danger {
        font-size: 1rem;
    }
}

    </style>

@push('styles')
    <!-- Push the custom stylesheet for the user details page -->
    @vite(['resources/css/showUser.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <!-- Card header with a gradient background -->
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">User Details</h2>
                </div>
                
                <div class="card-body p-5">
                    <!-- Display user information -->
                    <p class="mb-3"><strong>ID:</strong> {{ $usuario->id_cedula }}</p>
                    <p class="mb-3"><strong>Name:</strong> {{ $usuario->nombre }}</p>
                    <p class="mb-3"><strong>Surname:</strong> {{ $usuario->apellidos }}</p>
                    <p class="mb-3"><strong>Company:</strong> {{ $usuario->empresa ? $usuario->empresa->nombre_empresa : 'Not assigned' }}</p>
                    <p class="mb-3"><strong>Phone:</strong> {{ $usuario->telefono }}</p>
                    <p class="mb-3"><strong>Email:</strong> {{ $usuario->correo }}</p>
                    <p class="mb-3"><strong>Role:</strong> {{ $usuario->rol }}</p>
                    <!-- Display user status with a dynamic badge -->
                    <p class="mb-3"><strong>Status:</strong>
                        <span class="badge {{ $usuario->estado == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $usuario->estado }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <!-- Navigation buttons for returning, editing, and deleting the user -->
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary shadow-sm px-4 py-2">Back</a>
                <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-primary shadow-sm px-4 py-2">Edit</a>
                <button class="btn btn-outline-danger shadow-sm px-4 py-2 delete-user" data-id="{{ $usuario->id_cedula }}">Delete</button>

                <!-- Hidden form to delete user -->
                <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 for confirmation dialogs -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Event listener for the delete button
    document.querySelector('.delete-user').addEventListener('click', function () {
        let userId = this.getAttribute('data-id');  // Get user ID from the button's data attribute

        // Show a confirmation dialog with SweetAlert2
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            // If confirmed, submit the hidden form to delete the user
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    });
});
</script>
@endsection
