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
                           
    <a href="{{ route('mensualidad.index', $usuario->id_cedula) }}" class="btn btn-primary btn-sm">Mensualidad</a>
</td>


                            <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>

        <!-- Modal de Mensualidad -->
<div class="modal fade" id="mensualidadModal{{ $usuario->id_cedula }}" tabindex="-1" aria-labelledby="mensualidadModalLabel{{ $usuario->id_cedula }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mensualidad de {{ $usuario->nombre }} {{ $usuario->apellidos }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Mensualidades existentes -->
                <div id="mensualidad-list-{{ $usuario->id_cedula }}"></div>

                <!-- Formulario para asignar o editar mensualidad -->
                <form id="mensualidad-form-{{ $usuario->id_cedula }}" action="{{ route('mensualidad.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_cedula" value="{{ $usuario->id_cedula }}">
                    <input type="hidden" id="id_mensualidad-{{ $usuario->id_cedula }}" name="id_mensualidad">

                    <div class="mb-3">
                        <label for="fecha_inicio-{{ $usuario->id_cedula }}" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio-{{ $usuario->id_cedula }}" name="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin-{{ $usuario->id_cedula }}" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="fecha_fin-{{ $usuario->id_cedula }}" name="fecha_fin" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Mensualidad</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
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

    // Cargar mensualidades al abrir el modal
    document.querySelectorAll('.btn-primary[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.getAttribute('data-bs-target').replace('#mensualidadModal', '');
            let mensualidadList = document.getElementById(`mensualidad-list-${userId}`);
            mensualidadList.innerHTML = '<p class="text-center">Cargando...</p>';

            fetch(`/api/mensualidad/${userId}`)
                .then(response => response.json())
                .then(data => {
                    mensualidadList.innerHTML = '';
                    if (data.length === 0) {
                        mensualidadList.innerHTML = '<p class="text-center text-muted">No hay mensualidades asignadas.</p>';
                    } else {
                        data.forEach(mensualidad => {
                            mensualidadList.innerHTML += `
                                <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
                                    <span><strong>Inicio:</strong> ${mensualidad.fecha_inicio} | <strong>Fin:</strong> ${mensualidad.fecha_fin}</span>
                                    <button class="btn btn-danger btn-sm delete-mensualidad" data-id="${mensualidad.id_mensualidad}">Eliminar</button>
                                </div>`;
                        });

                        // Evento para eliminar mensualidad
                        document.querySelectorAll('.delete-mensualidad').forEach(btn => {
                            btn.addEventListener('click', function() {
                                let idMensualidad = this.getAttribute('data-id');

                                Swal.fire({
                                    title: '¿Eliminar mensualidad?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar'
                                }).then(result => {
                                    if (result.isConfirmed) {
                                        fetch(`/api/mensualidad/${idMensualidad}`, { method: 'DELETE' })
                                            .then(() => location.reload());
                                    }
                                });
                            });
                        });
                    }
                });
        });
    });
});
</script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    $('.btn-primary[data-bs-toggle="modal"]').on('click', function () {
        let userId = $(this).data('bs-target').replace('#mensualidadModal', '');
        let mensualidadList = $(`#mensualidad-list-${userId}`);

        mensualidadList.html('<p class="text-center">Cargando...</p>');

        // Cargar la vista parcial con las mensualidades
        $.get(`/mensualidad/${userId}`, function (html) {
            mensualidadList.html(html);
        }).fail(function () {
            mensualidadList.html('<p class="text-center text-danger">Error al cargar mensualidades.</p>');
        });
    });

    // Confirmación de eliminación con SweetAlert2
    $(document).on('submit', 'form', function (event) {
        let form = this;
        if ($(form).find('button[type="submit"]').text() === 'Eliminar') {
            event.preventDefault();

            Swal.fire({
                title: '¿Eliminar mensualidad?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});



    // Confirmación de envío de correo con SweetAlert2
    document.querySelectorAll('.btn-send-email').forEach(button => {
        button.addEventListener('click', function (event) {
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

