@extends('layouts.app')

@push('styles')
    <!-- Push the custom stylesheet for the user details page -->
    @vite(['resources/css/showUser.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <!-- Card header with a gradient background -->
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">User Details</h2>
                </div>
                
                <div class="card-body p-5">
                    <!-- Display user information -->
                    <p class="mb-3"><strong>ID:</strong> {{ $usuario->id_cedula }}</p>
                    <p class="mb-3"><strong>Name:</strong> {{ $usuario->nombre }}</p>
                    <p class="mb-3"><strong>Surname:</strong> {{ $usuario->apellidos }}</p>
                    <p class="mb-3"><strong>Company:</strong> {{ $usuario->empresa ? $usuario->empresa->nombre_empresa : 'Not assigned' }}</p>
                    <p class="mb-3"><strong>Phone:</strong> {{ $usuario->telefono }}</p>
                    <p class="mb-3"><strong>Email:</strong> {{ $usuario->correo }}</p>
                    <p class="mb-3"><strong>Role:</strong> {{ $usuario->rol }}</p>
                    <!-- Display user status with a dynamic badge -->
                    <p class="mb-3"><strong>Status:</strong>
                        <span class="badge {{ $usuario->estado == 'Active' ? 'bg-success' : 'bg-danger' }}">
                            {{ $usuario->estado }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <!-- Navigation buttons for returning, editing, and deleting the user -->
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary shadow-sm px-4 py-2">Back</a>
                <a href="{{ route('usuarios.edit', $usuario->id_cedula) }}" class="btn btn-outline-primary shadow-sm px-4 py-2">Edit</a>
                <button class="btn btn-outline-danger shadow-sm px-4 py-2 delete-user" data-id="{{ $usuario->id_cedula }}">Delete</button>

                <!-- Hidden form to delete user -->
                <form id="delete-form-{{ $usuario->id_cedula }}" action="{{ route('usuarios.destroy', $usuario->id_cedula) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 for confirmation dialogs -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Event listener for the delete button
    document.querySelector('.delete-user').addEventListener('click', function () {
        let userId = this.getAttribute('data-id');  // Get user ID from the button's data attribute

        // Show a confirmation dialog with SweetAlert2
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
            // If confirmed, submit the hidden form to delete the user
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    });
});
</script>
@endsection
