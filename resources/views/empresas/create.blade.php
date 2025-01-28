@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Empresa</h1>
    <form action="{{ route('empresas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cedula">Cédula</label>
            <input type="text" name="cedula" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tipo_cedula">Tipo de Cédula</label>
            <input type="text" name="tipo_cedula" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" name="correo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection