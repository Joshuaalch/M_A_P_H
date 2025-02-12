@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Reset Password') }} <!-- Header for password reset page -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }} <!-- Success message if status is set -->
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }} <!-- Display error message if validation fails -->
                                </div>
                            @enderror
                        </div>

                        <!-- Send Password Reset Link Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Password Reset Link') }} <!-- Button text to send the reset link -->
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
