@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ url('/lobby') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h1 class="text-center flex-grow-1">Companies</h1>
        <a href="{{ route('empresas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> New Company
        </a>
    </div>
    
    <!-- Search Bar -->
    <div class="mb-3 d-flex justify-content-center">
        <div class="input-group w-50">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search by name or ID...">
        </div>
    </div>
    
    <!-- Companies Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- We removed the "State" column -->
                </tr>
            </thead>
            <tbody id="empresaTable">
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->nombre }}</td>
                        <td>{{ $empresa->cedula }}</td>
                        <td>{{ $empresa->tipo_cedula }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->correo }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('empresas.show', $empresa->id_empresa) }}" class="btn btn-outline-info btn-sm" title="View Details">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button class="btn btn-outline-danger btn-sm delete-empresa" data-id="{{ $empresa->id_empresa }}" title="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                                <!-- Hidden Deletion Form -->
                                <form id="delete-form-{{ $empresa->id_empresa }}" action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Delete confirmation with SweetAlert2
    document.querySelectorAll('.delete-empresa').forEach(button => {
        button.addEventListener('click', function () {
            let empresaId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + empresaId).submit();
                }
            });
        });
    });

    // Real-time search
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#empresaTable tr');

        rows.forEach(row => {
            let name = row.cells[0].textContent.toLowerCase();
            let cedula = row.cells[1].textContent.toLowerCase();
            row.style.display = name.includes(filter) || cedula.includes(filter) ? '' : 'none';
        });
    });
});
</script>
@endsection
