@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">User List</h1>

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ url('/lobby') }}" class="btn btn-outline-secondary">Back</a>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Create User</a>
    </div>

    <div class="mb-3 d-flex justify-content-center">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search by name or ID...">
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surnames</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Company</th>
                    <th>Phone</th>
                    <th>Actions</th>
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
                        <td>{{ $usuario->empresa ? $usuario->empresa->nombre : 'Not assigned' }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>
                            <a href="{{ route('usuarios.show', $usuario->id_cedula) }}" class="btn btn-outline-info btn-sm">View</a>
                            <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                            <button class="btn btn-outline-danger btn-sm delete-user" data-id="{{ $usuario->id_cedula }}">Delete</button>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#contactModal{{ $usuario->id_cedula }}">Send Email</button>
                            <a href="{{ route('mensualidad.index', $usuario->id_cedula) }}" class="btn btn-primary btn-sm">Monthly Fee</a>
                        </td>

                        <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </tr>

        <!-- Monthly Fee Modal -->
        <div class="modal fade" id="mensualidadModal{{ $usuario->id_cedula }}" tabindex="-1" aria-labelledby="mensualidadModalLabel{{ $usuario->id_cedula }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Monthly Fee for {{ $usuario->nombre }} {{ $usuario->apellidos }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Existing Monthly Fees -->
                        <div id="mensualidad-list-{{ $usuario->id_cedula }}"></div>

                        <!-- Form to assign or edit monthly fee -->
                        <form id="mensualidad-form-{{ $usuario->id_cedula }}" action="{{ route('mensualidad.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_cedula" value="{{ $usuario->id_cedula }}">
                            <input type="hidden" id="id_mensualidad-{{ $usuario->id_cedula }}" name="id_mensualidad">

                            <div class="mb-3">
                                <label for="fecha_inicio-{{ $usuario->id_cedula }}" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="fecha_inicio-{{ $usuario->id_cedula }}" name="fecha_inicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_fin-{{ $usuario->id_cedula }}" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="fecha_fin-{{ $usuario->id_cedula }}" name="fecha_fin" required>
                            </div>
                            <button type="submit" class="btn btn-success">Save Monthly Fee</button>
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
                title: 'Send this email?',
                text: "Check the details before sending it.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Load monthly fees when opening the modal
    document.querySelectorAll('.btn-primary[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            let userId = this.getAttribute('data-bs-target').replace('#mensualidadModal', '');
            let mensualidadList = document.getElementById(`mensualidad-list-${userId}`);
            mensualidadList.innerHTML = '<p class="text-center">Loading...</p>';

            fetch(`/api/mensualidad/${userId}`)
                .then(response => response.json())
                .then(data => {
                    mensualidadList.innerHTML = '';
                    if (data.length === 0) {
                        mensualidadList.innerHTML = '<p class="text-center text-muted">No monthly fees assigned.</p>';
                    } else {
                        data.forEach(mensualidad => {
                            mensualidadList.innerHTML += `
                                <div class="d-flex justify-content-between align-items-center border p-2 mb-2">
                                    <span><strong>Start:</strong> ${mensualidad.fecha_inicio} | <strong>End:</strong> ${mensualidad.fecha_fin}</span>
                                    <button class="btn btn-danger btn-sm delete-mensualidad" data-id="${mensualidad.id_mensualidad}">Delete</button>
                                </div>`;
                        });

                        // Event to delete monthly fee
                        document.querySelectorAll('.delete-mensualidad').forEach(btn => {
                            btn.addEventListener('click', function() {
                                let idMensualidad = this.getAttribute('data-id');

                                Swal.fire({
                                    title: 'Delete monthly fee?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, delete',
                                    cancelButtonText: 'Cancel'
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

        mensualidadList.html('<p class="text-center">Loading...</p>');

        // Load the partial view with the monthly fees
        $.get(`/mensualidad/${userId}`, function (html) {
            mensualidadList.html(html);
        }).fail(function () {
            mensualidadList.html('<p class="text-center text-danger">Error loading monthly fees.</p>');
        });
    });

    // Confirmation of deletion with SweetAlert2
    $(document).on('submit', 'form', function (event) {
        let form = this;
        if ($(form).find('button[type="submit"]').text() === 'Delete') {
            event.preventDefault();

            Swal.fire({
                title: 'Delete monthly fee?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});

// Confirmation of email sending with SweetAlert2
document.querySelectorAll('.btn-send-email').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        let form = this.closest('form');

        Swal.fire({
            title: 'Send this email?',
            text: "Check the details before sending it.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, send',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
