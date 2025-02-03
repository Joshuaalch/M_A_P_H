@extends('layouts.app')

@section('content')
<div class="container mt-4">
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
                    <p class="card-text"><strong>Estado:</strong>
                        <span class="badge {{ $empresa->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $empresa->estado }}
                        </span>
                    </p>

                    <div class="d-flex gap-2">
                        <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-outline-primary" title="Editar">
                            Editar
                        </a>
                        <form action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta empresa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" title="Eliminar">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
