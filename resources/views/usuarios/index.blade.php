@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Lista de Usuarios</h2>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Botón "Volver" en la esquina superior izquierda -->
                    <a href="{{ url('/lobby') }}" class="btn btn-outline-secondary mb-3" style="position: absolute; top: 20px; left: 20px;">
                        Volver
                    </a>

                    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Empresa</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id_cedula }}</td>
                                    <td>{{ $usuario->nombre }}</td>
                                    <td>{{ $usuario->apellidos }}</td>
                                    <td>{{ $usuario->correo }}</td>
                                    <td>{{ $usuario->rol }}</td>
                                    <td>{{ $usuario->empresa ? $usuario->empresa->nombre_empresa : 'No asignada' }}</td>
                                    <td>{{ $usuario->telefono }}</td>
                                    <td>
                                        <a href="{{ route('usuarios.show', $usuario->id_cedula) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-warning btn-sm">Editar</a>
                                        
                                        <!-- Botón de Enviar Correo -->
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contactModal{{ $usuario->id_cedula }}">Enviar Correo</button>

                                        <!-- Modal para enviar correo -->
                                        <div class="modal fade" id="contactModal{{ $usuario->id_cedula }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $usuario->id_cedula }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="contactModalLabel{{ $usuario->id_cedula }}">Enviar Correo a {{ $usuario->nombre }} {{ $usuario->apellidos }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('usuarios.sendEmail', $usuario->id_cedula) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="mb-3">
                                                                <label for="subject" class="form-label">Asunto</label>
                                                                <input type="text" class="form-control" id="subject" name="subject" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="message" class="form-label">Mensaje</label>
                                                                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="attachments" class="form-label">Adjuntar archivos</label>
                                                                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                                                                <small class="form-text text-muted">Puedes adjuntar imágenes, documentos u otros archivos.</small>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Enviar Correo</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
