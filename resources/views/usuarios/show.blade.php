@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Detalles del Usuario') }}
                </div>
                <div class="card-body">
                    <p><strong>Cédula:</strong> {{ $usuario->id_cedula }}</p>
                    <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
                    <p><strong>Apellidos:</strong> {{ $usuario->apellidos }}</p>
                    <p><strong>Empresa:</strong> {{ $usuario->empresa ? $usuario->empresa->nombre_empresa : 'No asignada' }}</p>
                    <p><strong>Teléfono:</strong> {{ $usuario->telefono }}</p>
                    <p><strong>Correo:</strong> {{ $usuario->correo }}</p>
                    <p><strong>Rol:</strong> {{ $usuario->rol }}</p>
                    <p><strong>Estado:</strong>
                        <span class="badge {{ $usuario->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $usuario->estado }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver</a>
                <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-primary">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
