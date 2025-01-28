@extends('layouts.app')

@section('content')
    <h1>Detalles de la Empresa</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $empresa->nombre }}</h5>
            <p class="card-text"><strong>Cédula:</strong> {{ $empresa->cedula }}</p>
            <p class="card-text"><strong>Tipo de Cédula:</strong> {{ $empresa->tipo_cedula }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $empresa->telefono }}</p>
            <p class="card-text"><strong>Correo:</strong> {{ $empresa->correo }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ $empresa->estado }}</p>
            <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
@endsection