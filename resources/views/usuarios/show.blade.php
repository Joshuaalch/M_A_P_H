@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Detalles del Usuario</h2>
                </div>
                
                <div class="card-body p-5">
                    <p class="mb-3"><strong>Cédula:</strong> {{ $usuario->id_cedula }}</p>
                    <p class="mb-3"><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
                    <p class="mb-3"><strong>Apellidos:</strong> {{ $usuario->apellidos }}</p>
                    <p class="mb-3"><strong>Empresa:</strong> {{ $usuario->empresa ? $usuario->empresa->nombre_empresa : 'No asignada' }}</p>
                    <p class="mb-3"><strong>Teléfono:</strong> {{ $usuario->telefono }}</p>
                    <p class="mb-3"><strong>Correo:</strong> {{ $usuario->correo }}</p>
                    <p class="mb-3"><strong>Rol:</strong> {{ $usuario->rol }}</p>
                    <p class="mb-3"><strong>Estado:</strong>
                        <span class="badge {{ $usuario->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $usuario->estado }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary shadow-sm px-4 py-2">Volver</a>
                <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-primary shadow-sm px-4 py-2">Editar</a>
                <button class="btn btn-outline-danger shadow-sm px-4 py-2 delete-user" data-id="{{ $usuario->id_cedula }}">Eliminar</button>

                <!-- Formulario oculto para eliminar usuario -->
                <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Confirmación de eliminación con SweetAlert2
    document.querySelector('.delete-user').addEventListener('click', function () {
        let userId = this.getAttribute('data-id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    });
});
</script>
@endsection
