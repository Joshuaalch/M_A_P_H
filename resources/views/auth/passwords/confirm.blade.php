@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    {{ __('Confirm Password') }} <!-- Header for password confirmation -->
                </div>

                <div class="card-body">
                    <p class="mb-3">
                        {{ __('Please confirm your password before continuing.') }} <!-- Instruction to confirm the password -->
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }} <!-- Display error message if validation fails -->
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Confirm Password') }} <!-- Button text for confirming the password -->
                            </button>
                        </div>

                        <!-- Link to Reset Password -->
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    {{ __('Forgot Your Password?') }} <!-- Link for password recovery -->
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
