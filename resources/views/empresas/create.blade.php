@extends('layouts.app')

@push('styles')
    @vite(['resources/css/createEmpresa.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Registration Card with .card class -->
            <div class="card">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Create New Company</h2> <!-- Form header with title -->
                </div>
                
                <div class="card-body p-5">
                    <!-- Show success with SweetAlert -->
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

                    <form action="{{ route('empresas.store') }}" method="POST" id="empresaForm">
                        @csrf

                        <!-- Company Name Field -->
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-semibold">Company Name</label>
                            <input id="nombre" type="text" class="form-control p-3 shadow-sm @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required placeholder="Example S.A.">
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- ID and ID Type Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="cedula" class="form-label fw-semibold">ID Number</label>
                                <input id="cedula" type="text" class="form-control p-3 shadow-sm @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required placeholder="Enter ID number">
                                @error('cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tipo_cedula" class="form-label fw-semibold">ID Type</label>
                                <select id="tipo_cedula" class="form-select p-3 shadow-sm @error('tipo_cedula') is-invalid @enderror" name="tipo_cedula" required>
                                    <option value="FI" {{ old('tipo_cedula') == 'FI' ? 'selected' : '' }}>Physical</option>
                                    <option value="JU" {{ old('tipo_cedula') == 'JU' ? 'selected' : '' }}>Legal</option>
                                </select>
                                @error('tipo_cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <!-- Phone and Email Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="telefono" class="form-label fw-semibold">Phone</label>
                                <input id="telefono" type="text" class="form-control p-3 shadow-sm @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>
                                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="correo" class="form-label fw-semibold">Email</label>
                                <input id="correo" type="email" class="form-control p-3 shadow-sm @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required>
                                @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="mb-4">
                            <label for="estado" class="form-label fw-semibold">Status</label>
                            <select id="estado" class="form-select p-3 shadow-sm @error('estado') is-invalid @enderror" name="estado" required>
                                <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Save Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="guardarBtn">Save Company</button> <!-- Submit button to save the company -->
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
    document.getElementById('empresaForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: 'Save this company?',
            text: "Make sure the data is correct before confirming.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); <!-- Submits the form if confirmed -->
            }
        });
    });
});
</script>

@endsection
