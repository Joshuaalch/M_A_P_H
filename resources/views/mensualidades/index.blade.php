@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Monthly Fees of {{ $usuario->nombre }} {{ $usuario->apellidos }}</h1>

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Back to Users</a>
    </div>

    <!-- Show success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Monthly Fees Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensualidades as $mensualidad)
                    <tr>
                        <td>{{ $mensualidad->fecha_inicio }}</td>
                        <td>{{ $mensualidad->fecha_fin }}</td>
                        <td>{{ $mensualidad->estado ? 'Active' : 'Inactive' }}</td>
                        <td>
                        <a href="{{ route('mensualidad.edit', $mensualidad->id_mensualidad) }}" class="btn btn-warning btn-sm">
        Edit
    </a>


                            <form action="{{ route('mensualidad.destroy', $mensualidad->id_mensualidad) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Form to add a new monthly fee -->
    <h2 class="mt-4">Assign New Monthly Fee</h2>
    <form action="{{ route('mensualidad.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_cedula" value="{{ $usuario->id_cedula }}">

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="fecha_inicio" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="fecha_fin" required>
        </div>

        <button type="submit" class="btn btn-success">Save Monthly Fee</button>
    </form>

    <!-- Form to edit monthly fee (hidden by default) -->
    <div id="edit-section" class="mt-5 d-none">
        <h2>Edit Monthly Fee</h2>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit-id" name="id_mensualidad">

            <div class="mb-3">
                <label class="form-label">Start Date</label>
                <input type="date" class="form-control" id="edit-fecha-inicio" name="fecha_inicio" required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Date</label>
                <input type="date" class="form-control" id="edit-fecha-fin" name="fecha_fin" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Monthly Fee</button>
            <button type="button" id="cancel-edit" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Confirmation to delete monthly fee
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            let formElement = this;

            Swal.fire({
                title: 'Delete monthly fee?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    formElement.submit();
                }
            });
        });
    });

    // Show edit form when clicking "Edit"
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let id = this.getAttribute('data-id');
            let fechaInicio = this.getAttribute('data-fecha-inicio');
            let fechaFin = this.getAttribute('data-fecha-fin');

            // Show edit form
            document.getElementById('edit-section').classList.remove('d-none');

            // Fill the edit form values
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-fecha-inicio').value = fechaInicio;
            document.getElementById('edit-fecha-fin').value = fechaFin;

            // Set the form action with the correct URL
            let editForm = document.getElementById('edit-form');
            editForm.action = `/mensualidad/${id}`;
        });
    });

    // Cancel editing
    document.getElementById('cancel-edit').addEventListener('click', function () {
        document.getElementById('edit-section').classList.add('d-none');
    });
});
</script>
@endsection
