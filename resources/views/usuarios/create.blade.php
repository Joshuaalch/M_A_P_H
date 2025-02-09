@extends('layouts.app')

@push('styles')
    @vite(['resources/css/createUser.css'])
@endpush

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
