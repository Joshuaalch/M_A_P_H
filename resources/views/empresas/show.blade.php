@extends('layouts.app')
<style>
    /* Navigation Bar */
nav.navbar {
    padding: 0.2rem 0.2rem; 
    width: 100%;
    box-sizing: border-box;
    background: linear-gradient(135deg, rgb(190, 223, 247), rgb(255, 255, 255));
    color: #000;
}

/* Main Container */
.container {
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    min-height: 10vh;
    color: #000000;
}

/* Details Card */
.card {
    border: none;
    border-radius: 15px;
    background: linear-gradient(135deg,rgb(246, 248, 250), rgb(185, 243, 243));
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    transform: translateY(-100px);
    animation: slideIn 0.8s ease forwards;
    width: 100%;
    max-width: 550px;
}

@keyframes slideIn {
    from {
        transform: translateY(-100px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Form Header Style */
.card-header {
    background-color: rgb(248, 167, 198);
    color: rgb(248, 167, 198);
    text-align: center;
    padding: 1rem;
    font-size: 1.5rem;
    font-weight: bold;
}

.card-header h2 {
    color: rgb(245, 132, 220);
}

/* Paragraph Style */
.card-body p {
    font-size: 1.2rem;
    margin-bottom: 15px;
}

/* Button Style */
button, .btn {
    width: 48%;
    padding: 12px;
    font-size: 1rem;
    border-radius: 25px;
    font-weight: bold;
    transition: transform 0.3s ease;
    display: inline-block;
    margin: 0.5rem;
}

/* Secondary and Primary Buttons */
.btn-outline-secondary, .btn-outline-primary, .btn-outline-danger {
    padding: 12px 25px;
    border-radius: 25px;
    border: 2px solid #bbdefb;
    color: #000;
    background: transparent;
}

.btn-outline-secondary:hover, .btn-outline-primary:hover, .btn-outline-danger:hover {
    background: linear-gradient(135deg, rgb(248, 84, 185), rgb(174, 234, 241));
    transform: scale(1.05);
}

/* Link Style */
a {
    color: rgb(245, 95, 120);
    text-decoration: none;
    transition: color 0.3s ease;
    text-align: center;
    display: block;
    margin-top: 1rem;
}

a:hover {
    text-decoration: underline;
    color: #64b5f6;
}

/* Adjustments for Small Screens */
@media (max-width: 576px) {
    .container {
        left: 0;
        transform: translateX(0);
    }
    .card-body {
        padding: 1.5rem;
    }
    .btn-outline-secondary, .btn-outline-primary, .btn-outline-danger {
        font-size: 1rem;
    }
}

</style>

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
