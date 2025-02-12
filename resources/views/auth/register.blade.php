@extends('layouts.app')

@push('styles')
    <!-- Linking the register.css file using Vite -->
    @vite(['resources/css/register.css'])
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>{{ __('Register') }}</h2>
                </div>

                <div class="card-body">
                    <!-- Display a success message when registration is successful -->
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Registration Successful',
                                text: '{{ session('success') }}',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="registroForm">
                        @csrf

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                   placeholder="Enter your name">
                            @error('name')
                                <!-- Error message if validation fails for name -->
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
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
                                   name="password" required autocomplete="new-password"
                                   placeholder="Enter your password">
                            @error('password')
                                <!-- Error message if validation fails for password -->
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirm your password">
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="registroBtn">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Importing SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to the registration form
    document.getElementById('registroForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the immediate form submission

        // Display a confirmation modal before submitting the form
        Swal.fire({
            title: 'Confirm Registration?',
            text: "Make sure the entered data is correct.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, register me',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit(); // Submit the form only if the user confirms
            }
        });
    });
});
</script>
