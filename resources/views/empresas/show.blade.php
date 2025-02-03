@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Detalles de la Empresa') }}
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ $empresa->nombre }}</h5>
                    <p class="card-text"><strong>Cédula:</strong> {{ $empresa->cedula }}</p>
                    <p class="card-text"><strong>Tipo de Cédula:</strong> {{ $empresa->tipo_cedula }}</p>
                    <p class="card-text"><strong>Teléfono:</strong> {{ $empresa->telefono }}</p>
                    <p class="card-text"><strong>Correo:</strong> {{ $empresa->correo }}</p>
                    <p class="card-text"><strong>Estado:</strong> {{ $empresa->estado }}</p>

                    <!-- Botón de Editar -->
                    <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-primary">
                        {{ __('Editar') }}
                    </a>

                    <!-- Formulario para Eliminar -->
                    <form action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            {{ __('Eliminar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
