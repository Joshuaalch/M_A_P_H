@extends('layouts.app')

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
