@extends('layouts.app')

@section('content')
    <h1>Editar Empresa</h1>
    <form action="{{ route('empresas.update', $empresa->id_empresa) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $empresa->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" class="form-control" value="{{ $empresa->cedula }}" required>
        </div>
        <div class="form-group">
            <label for="tipo_cedula">Tipo de Cédula</label>
            <input type="text" name="tipo_cedula" class="form-control" value="{{ $empresa->tipo_cedula }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $empresa->telefono }}" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ $empresa->correo }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $empresa->estado }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection