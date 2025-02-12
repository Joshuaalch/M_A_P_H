@extends('layouts.app')

@push('styles')
    @vite(['resources/css/empresaEdit.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Edit Company</h2>
                </div>
                
                <div class="card-body p-5">
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <form action="{{ route('empresas.update', $empresa->id_empresa) }}" method="POST" id="editarEmpresaForm">
                        @csrf
                        @method('PUT')

                        <!-- Company Name Field -->
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-semibold">Company Name</label>
                            <input id="nombre" type="text" class="form-control p-3 shadow-sm @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $empresa->nombre) }}" required placeholder="Example S.A.">
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <!-- ID Field -->
                            <div class="col-md-6 mb-4">
                                <label for="cedula" class="form-label fw-semibold">ID</label>
                                <input id="cedula" type="text" class="form-control p-3 shadow-sm @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula', $empresa->cedula) }}" required placeholder="Enter ID">
                                @error('cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <!-- ID Type Field -->
                            <div class="col-md-6 mb-4">
                                <label for="tipo_cedula" class="form-label fw-semibold">ID Type</label>
                                <input id="tipo_cedula" type="text" class="form-control p-3 shadow-sm @error('tipo_cedula') is-invalid @enderror" name="tipo_cedula" value="{{ old('tipo_cedula', $empresa->tipo_cedula) }}" required>
                                @error('tipo_cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Phone Field -->
                            <div class="col-md-6 mb-4">
                                <label for="telefono" class="form-label fw-semibold">Phone</label>
                                <input id="telefono" type="text" class="form-control p-3 shadow-sm @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono', $empresa->telefono) }}" required>
                                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <!-- Email Field -->
                            <div class="col-md-6 mb-4">
                                <label for="correo" class="form-label fw-semibold">Email</label>
                                <input id="correo" type="email" class="form-control p-3 shadow-sm @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo', $empresa->correo) }}" required>
                                @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="mb-4">
                            <label for="estado" class="form-label fw-semibold">Status</label>
                            <select id="estado" class="form-select p-3 shadow-sm @error('estado') is-invalid @enderror" name="estado" required>
                                <option value="Activo" {{ old('estado', $empresa->estado) == 'Activo' ? 'selected' : '' }}>Active</option>
                                <option value="Inactivo" {{ old('estado', $empresa->estado) == 'Inactivo' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="actualizarBtn">Update Company</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('editarEmpresaForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: 'Update this company?',
            text: "Please verify that the information is correct before confirming.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@endsection
