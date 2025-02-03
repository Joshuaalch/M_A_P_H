@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Editar Empresa') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('empresas.update', $empresa->id_empresa) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $empresa->nombre) }}" required placeholder="Ingresa el nombre de la empresa">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula', $empresa->cedula) }}" required placeholder="Ingresa la cédula">
                            @error('cedula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tipo_cedula" class="form-label">Tipo de Cédula</label>
                            <input id="tipo_cedula" type="text" class="form-control @error('tipo_cedula') is-invalid @enderror" name="tipo_cedula" value="{{ old('tipo_cedula', $empresa->tipo_cedula) }}" required placeholder="Ingresa el tipo de cédula">
                            @error('tipo_cedula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono', $empresa->telefono) }}" required placeholder="Ingresa el teléfono">
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo', $empresa->correo) }}" required placeholder="Ingresa el correo">
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required>
                                <option value="Activo" {{ old('estado', $empresa->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $empresa->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection