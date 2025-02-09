@extends('layouts.app')
@push('styles')
    @vite(['resources/css/createEmpresa.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tarjeta de registro con la clase .card -->
            <div class="card">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Crear Nueva Empresa</h2>
                </div>
                
                <div class="card-body p-5">
                    <!-- Mostrar éxito con SweetAlert -->
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <form action="{{ route('empresas.store') }}" method="POST" id="empresaForm">
                        @csrf

                        <!-- Campo Nombre de la Empresa -->
                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-semibold">Nombre de la Empresa</label>
                            <input id="nombre" type="text" class="form-control p-3 shadow-sm @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required placeholder="Ejemplo S.A.">
                            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Campos de Cédula y Tipo de Cédula -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="cedula" class="form-label fw-semibold">Cédula</label>
                                <input id="cedula" type="text" class="form-control p-3 shadow-sm @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}" required placeholder="Ingrese la cédula">
                                @error('cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="tipo_cedula" class="form-label fw-semibold">Tipo de Cédula</label>
                                <input id="tipo_cedula" type="text" class="form-control p-3 shadow-sm @error('tipo_cedula') is-invalid @enderror" name="tipo_cedula" value="{{ old('tipo_cedula') }}" required>
                                @error('tipo_cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <!-- Campos de Teléfono y Correo Electrónico -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="telefono" class="form-label fw-semibold">Teléfono</label>
                                <input id="telefono" type="text" class="form-control p-3 shadow-sm @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required>
                                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="correo" class="form-label fw-semibold">Correo Electrónico</label>
                                <input id="correo" type="email" class="form-control p-3 shadow-sm @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required>
                                @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <!-- Campo Estado -->
                        <div class="mb-4">
                            <label for="estado" class="form-label fw-semibold">Estado</label>
                            <select id="estado" class="form-select p-3 shadow-sm @error('estado') is-invalid @enderror" name="estado" required>
                                <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Botón Guardar -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="guardarBtn">Guardar Empresa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('empresaForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Guardar esta empresa?',
            text: "Verifica que los datos sean correctos antes de confirmar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>

@endsection