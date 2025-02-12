@extends('layouts.app')

@push('styles')
    <!-- Linking the reset.css file from public/css/ -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <!-- You can add more CSS if needed -->
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}"> <!-- If you have this file for additional customization -->
@endpush

@section('content')
<div class="container custom-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Reset Password') }} <!-- Header for the reset password page -->
                </div>

                <div class="card-body custom-card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Hidden Token Field -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }} <!-- Error message for email field if validation fails -->
                                </div>
                            @enderror
                        </div>

                        <!-- New Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="new-password"
                                   placeholder="Enter your new password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }} <!-- Error message for password field if validation fails -->
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm New Password Field -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm New Password</label>
                            <input id="password-confirm" type="password" class="form-control custom-form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirm your new password">
                        </div>

                        <!-- Reset Password Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary custom-btn-primary">
                                {{ __('Reset Password') }} <!-- Button text to reset the password -->
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
