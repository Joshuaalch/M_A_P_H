@extends('layouts.app')
@push('styles')
    @vite(['resources/css/userEdit.css'])
@endpush

@push('styles')
    @vite(['resources/css/userEdit.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Editar Perfil</h2>
                </div>
                
                <div class="card-body p-5">
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

                    <form action="{{ route('profile.update') }}" method="POST" id="editarPerfilForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input id="name" type="text" class="form-control p-3 shadow-sm @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required placeholder="Ingresa tu nombre">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control p-3 shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required placeholder="Ingresa tu correo electrónico">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Nueva Contraseña (opcional)</label>
                            <input id="password" type="password" class="form-control p-3 shadow-sm @error('password') is-invalid @enderror" name="password" placeholder="Ingresa tu nueva contraseña">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-semibold">Confirmar Nueva Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control p-3 shadow-sm" name="password_confirmation" placeholder="Confirma tu nueva contraseña">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="guardarBtn">Guardar Cambios</button>
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
    document.getElementById('editarPerfilForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: '¿Guardar cambios en el perfil?',
            text: "Asegúrate de que la información es correcta",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, actualizar',
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
