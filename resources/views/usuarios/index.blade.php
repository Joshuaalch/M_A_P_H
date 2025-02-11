@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Lista de Usuarios</h1>

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ url('/lobby') }}" class="btn btn-outline-secondary">Volver</a>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Crear Usuario</a>
    </div>

    <div class="mb-3 d-flex justify-content-center">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Buscar por nombre o cédula...">
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
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
            <tbody id="userTable">
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id_cedula }}</td>
                        <td class="usuario-nombre">{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td>{{ $usuario->rol }}</td>
                        <td>{{ $usuario->empresa ? $usuario->empresa->nombre : 'No asignada' }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>
                            <a href="{{ route('usuarios.show', $usuario->id_cedula) }}" class="btn btn-outline-info btn-sm">Ver</a>
                            <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                            <button class="btn btn-outline-danger btn-sm delete-user" data-id="{{ $usuario->id_cedula }}">Eliminar</button>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contactModal{{ $usuario->id_cedula }}">Enviar Correo</button>
                            <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

                    <!-- Modal para enviar correo -->
                    <div class="modal fade" id="contactModal{{ $usuario->id_cedula }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $usuario->id_cedula }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contactModalLabel{{ $usuario->id_cedula }}">Enviar Correo a {{ $usuario->nombre }} {{ $usuario->apellidos }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('usuarios.sendEmail', $usuario->id_cedula) }}" method="POST" enctype="multipart/form-data" class="email-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="subject-{{ $usuario->id_cedula }}" class="form-label">Asunto</label>
                                            <input type="text" class="form-control" id="subject-{{ $usuario->id_cedula }}" name="subject" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-{{ $usuario->id_cedula }}" class="form-label">Mensaje</label>
                                            <textarea class="form-control" id="message-{{ $usuario->id_cedula }}" name="message" rows="4" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="attachments-{{ $usuario->id_cedula }}" class="form-label">Adjuntar archivos</label>
                                            <input type="file" class="form-control" id="attachments-{{ $usuario->id_cedula }}" name="attachments[]" multiple>
                                            <small class="form-text text-muted">Puedes adjuntar imágenes, documentos u otros archivos.</small>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-send-email" data-id="{{ $usuario->id_cedula }}">Enviar Correo</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Confirmación de envío de correo con SweetAlert2
    document.querySelectorAll('.btn-send-email').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let form = this.closest('form'); // Obtiene el formulario dentro del modal

            Swal.fire({
                title: '¿Enviar este correo?',
                text: "Verifica los detalles antes de enviarlo.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario
                    form.submit();

                    // Cerrar el modal después de enviar
                    let modal = bootstrap.Modal.getInstance(document.getElementById(form.closest('.modal').id));
                    modal.hide();
                }
            });
        });
    });
});


    // Búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#userTable tr');

        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase();
            let cedula = row.cells[0].textContent.toLowerCase();
            row.style.display = name.includes(filter) || cedula.includes(filter) ? '' : 'none';
        });
    });

    // Confirmación de envío de correo
    document.querySelectorAll('.btn-send-email').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let form = this.closest('form');

            Swal.fire({
                title: '¿Enviar este correo?',
                text: "Verifica los detalles antes de enviarlo.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, enviar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
