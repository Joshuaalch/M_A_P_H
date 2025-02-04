@extends('layouts.app')

@push('styles')
    <!-- Vinculando el archivo reset.css desde public/css/ -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <!-- Puedes agregar más CSS si es necesario -->
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"> <!-- Si tienes este archivo para personalizar más -->
@endpush

@section('content')
<div class="container custom-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Restablecer Contraseña') }}
                </div>

                <div class="card-body custom-card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Token Oculto -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Campo de Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Ingresa tu correo electrónico">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Ingresa tu nueva contraseña">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Campo de Confirmar Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirmar Nueva Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control custom-form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirma tu nueva contraseña">
                        </div>

                        <!-- Botón de Restablecer Contraseña -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary custom-btn-primary">
                                {{ __('Restablecer Contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
