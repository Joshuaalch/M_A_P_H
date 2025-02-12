@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Mensualidades de {{ $usuario->nombre }} {{ $usuario->apellidos }}</h1>

    <div class="mb-3 d-flex justify-content-between">
        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">Volver a Usuarios</a>
    </div>

    <!-- Mostrar mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabla de Mensualidades -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mensualidades as $mensualidad)
                    <tr>
                        <td>{{ $mensualidad->fecha_inicio }}</td>
                        <td>{{ $mensualidad->fecha_fin }}</td>
                        <td>{{ $mensualidad->estado ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                        <a href="{{ route('mensualidad.edit', $mensualidad->id_mensualidad) }}" class="btn btn-warning btn-sm">
        Editar
    </a>


                            <form action="{{ route('mensualidad.destroy', $mensualidad->id_mensualidad) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Formulario para agregar nueva mensualidad -->
    <h2 class="mt-4">Asignar Nueva Mensualidad</h2>
    <form action="{{ route('mensualidad.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_cedula" value="{{ $usuario->id_cedula }}">

        <div class="mb-3">
            <label class="form-label">Fecha de Inicio</label>
            <input type="date" class="form-control" name="fecha_inicio" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Fin</label>
            <input type="date" class="form-control" name="fecha_fin" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Mensualidad</button>
    </form>

    <!-- Formulario para editar mensualidad (oculto por defecto) -->
    <div id="edit-section" class="mt-5 d-none">
        <h2>Editar Mensualidad</h2>
        <form id="edit-form" action="" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit-id" name="id_mensualidad">

            <div class="mb-3">
                <label class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="edit-fecha-inicio" name="fecha_inicio" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="edit-fecha-fin" name="fecha_fin" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Mensualidad</button>
            <button type="button" id="cancel-edit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Confirmación para eliminar mensualidad
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            let formElement = this;

            Swal.fire({
                title: '¿Eliminar mensualidad?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then(result => {
                if (result.isConfirmed) {
                    formElement.submit();
                }
            });
        });
    });

    // Mostrar formulario de edición cuando se hace clic en "Editar"
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            let id = this.getAttribute('data-id');
            let fechaInicio = this.getAttribute('data-fecha-inicio');
            let fechaFin = this.getAttribute('data-fecha-fin');

            // Mostrar formulario de edición
            document.getElementById('edit-section').classList.remove('d-none');

            // Rellenar los valores del formulario de edición
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-fecha-inicio').value = fechaInicio;
            document.getElementById('edit-fecha-fin').value = fechaFin;

            // Configurar la acción del formulario con la URL correcta
            let editForm = document.getElementById('edit-form');
            editForm.action = `/mensualidad/${id}`;
        });
    });

    // Cancelar edición
    document.getElementById('cancel-edit').addEventListener('click', function () {
        document.getElementById('edit-section').classList.add('d-none');
    });
});
</script>
@endsection
