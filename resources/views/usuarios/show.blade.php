@extends('layouts.app')

@section('content')
<div class="container">
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
                    <p><strong>Empresa:</strong> {{ $usuario->empresa->nombre_empresa }}</p>
                    <p><strong>Teléfono:</strong> {{ $usuario->telefono }}</p>
                    <p><strong>Correo:</strong> {{ $usuario->correo }}</p>
                    <p><strong>Rol:</strong> {{ $usuario->rol }}</p>
                    <p><strong>Estado:</strong> {{ $usuario->estado }}</p>
                </div>
            </div>

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection
