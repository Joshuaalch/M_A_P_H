@extends('layouts.app')

@push('styles')
    <!-- Linking the login.css file using Vite -->
    @vite(['resources/css/login.css'])
@endpush

@section('content')
<!-- Independent Logo above the form -->
<div class="logo-container text-center">
    <img src="{{ asset('storage/img/logo1.png') }}" alt="MAPH Logo" class="logo">
</div>

<!-- Login Form Container -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <!-- Title for the login form -->
                    <h2 class="card-title text-center mb-4">Log In</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Enter your email address">
                            @error('email')
                                <!-- Error message if validation fails for email -->
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="Enter your password">
                            @error('password')
                                <!-- Error message if validation fails for password -->
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Log In
                            </button>
                        </div>

                        <!-- Link to Reset Password -->
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
