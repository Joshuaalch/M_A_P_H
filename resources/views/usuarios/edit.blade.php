@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Editar Usuario') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('usuarios.update', $usuario->id_cedula) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_cedula" class="form-label">Cédula</label>
                            <input type="text" name="id_cedula" id="id_cedula" class="form-control" value="{{ $usuario->id_cedula }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_cedula" class="form-label">Tipo de Cédula</label>
                            <input type="text" name="tipo_cedula" id="tipo_cedula" class="form-control" value="{{ $usuario->tipo_cedula }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_empresa" class="form-label">Empresa</label>
                            <select name="id_empresa" id="id_empresa" class="form-control" required>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id_empresa }}" {{ $usuario->id_empresa == $empresa->id_empresa ? 'selected' : '' }}>
                                        {{ $empresa->nombre_empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $usuario->apellidos }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $usuario->telefono }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="{{ $usuario->correo }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña (opcional)</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <input type="text" name="rol" id="rol" class="form-control" value="{{ $usuario->rol }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" class="form-control" name="estado" required>
                                <option value="Activo" {{ $usuario->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ $usuario->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
