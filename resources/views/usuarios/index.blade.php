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
                        <td>{{ $usuario->empresa ? $usuario->empresa->nombre_empresa : 'No asignada' }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>
                            <a href="{{ route('usuarios.show', $usuario->id_cedula) }}" class="btn btn-outline-info btn-sm">Ver</a>
                            <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                            <button class="btn btn-outline-danger btn-sm delete-user" data-id="{{ $usuario->id_cedula }}">Eliminar</button>
                            <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Confirmación de eliminación con SweetAlert2
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function () {
            let userId = this.getAttribute('data-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
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
});
</script>
@endsection
