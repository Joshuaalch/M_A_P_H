@extends('layouts.app')

@push('styles')
    <!-- Include custom styles for the user creation page -->
    @vite(['resources/css/createUser.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <!-- Page title: Create User -->
                    <h2 class="fw-bold">Create User</h2>
                </div>
                
                <div class="card-body p-5">
                    <!-- Display success message if any -->
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
                  
                    <!-- Form to create a new user -->
                    <form action="{{ route('usuarios.store') }}" method="POST" id="crearUsuarioForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <!-- Input for user ID -->
                                <label for="id_cedula" class="form-label fw-semibold">ID</label>
                                <input type="text" name="id_cedula" id="id_cedula" class="form-control p-3 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <!-- Dropdown to select ID type -->
                                <label for="tipo_cedula" class="form-label fw-semibold">ID Type</label>
                                <select name="tipo_cedula" id="tipo_cedula" class="form-select p-3 shadow-sm" required>
                                    <option value="NAC">National</option>
                                    <option value="EXT">Foreign</option>
                                </select>
                            </div>
                        </div>

                         <div class="mb-4">
                             <!-- Dropdown to select company -->
                             <label for="id_empresa" class="form-label fw-semibold">Company</label>
                             <select name="id_empresa" id="id_empresa" class="form-select p-3 shadow-sm" required>
                                 @foreach ($empresas as $empresa)
                                     <option value="{{ $empresa['id_empresa'] }}">{{ $empresa['nombre'] }}</option>
                                 @endforeach
                             </select>
                         </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <!-- Input for user's first name -->
                                <label for="nombre" class="form-label fw-semibold">First Name</label>
                                <input type="text" name="nombre" id="nombre" class="form-control p-3 shadow-sm" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <!-- Input for user's last name -->
                                <label for="apellidos" class="form-label fw-semibold">Last Name</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control p-3 shadow-sm" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <!-- Input for user's phone number -->
                            <label for="telefono" class="form-label fw-semibold">Phone</label>
                            <input type="text" name="telefono" id="telefono" class="form-control p-3 shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <!-- Input for user's email -->
                            <label for="correo" class="form-label fw-semibold">Email</label>
                            <input type="email" name="correo" id="correo" class="form-control p-3 shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <!-- Input for password -->
                            <label for="contrasena" class="form-label fw-semibold">Password</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control p-3 shadow-sm" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <!-- Dropdown to select role -->
                                <label for="rol" class="form-label fw-semibold">Role</label>
                                <select name="rol" id="rol" class="form-select p-3 shadow-sm" required>
                                    <option value="ADMI">Admin</option>
                                    <option value="AYUD">Assistant</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <!-- Dropdown to select account status -->
                                <label for="estado" class="form-label fw-semibold">Status</label>
                                <select id="estado" class="form-select p-3 shadow-sm" name="estado" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Buttons to go back or submit form -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-lg btn-primary shadow-sm fw-bold px-4 py-2">Back</a>
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold px-4 py-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
