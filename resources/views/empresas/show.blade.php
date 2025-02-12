@extends('layouts.app')

@push('styles')
    @vite(['resources/css/showEmpresa.css'])
@endpush

@section('content')
<!-- Main container for displaying company details -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card to display company information -->
            <div class="card border-0 shadow-lg rounded-4">
                
                <!-- Card header with a gradient background for the title -->
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Company Details</h2>
                </div>
                
                <!-- Card body with company details -->
                <div class="card-body p-5">
                    <!-- Company Name -->
                    <h4 class="fw-bold text-primary">{{ $empresa->nombre }}</h4>
                    <hr>
                    
                    <!-- Display company details like ID, phone, email, and status -->
                    <p class="card-text"><strong>ID:</strong> {{ $empresa->cedula }}</p>
                    <p class="card-text"><strong>ID Type:</strong> {{ $empresa->tipo_cedula }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $empresa->telefono }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $empresa->correo }}</p>
                    <p class="card-text"><strong>Status:</strong>
                        <!-- Status badge, either green for Active or red for Inactive -->
                        <span class="badge {{ $empresa->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $empresa->estado }}
                        </span>
                    </p>

                    <!-- Buttons for editing and deleting the company details -->
                    <div class="d-flex gap-3 mt-4">
                        <!-- Edit button that links to the edit form -->
                        <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-outline-primary shadow-sm px-4 py-2">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        
                        <!-- Delete button that triggers the deletion confirmation -->
                        <button class="btn btn-outline-danger shadow-sm px-4 py-2 delete-empresa" data-id="{{ $empresa->id_empresa }}">
                            <i class="bi bi-trash-fill"></i> Delete
                        </button>
                    </div>

                    <!-- Hidden form for submitting the deletion request -->
                    <form id="delete-form-{{ $empresa->id_empresa }}" action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert2 library for deletion confirmation popup -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to the delete button
    document.querySelector('.delete-empresa').addEventListener('click', function () {
        let empresaId = this.getAttribute('data-id'); // Get the company ID

        // SweetAlert2 confirmation popup
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
            // If confirmed, submit the hidden deletion form
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + empresaId).submit();
            }
        });
    });
});
</script>
@endsection
