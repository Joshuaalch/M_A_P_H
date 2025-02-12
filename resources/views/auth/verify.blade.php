@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>{{ __('Verify Your Email Address') }}</h2>
                </div>

                <div class="card-body text-center">
                    <!-- Show success message when a verification email is resent -->
                    @if (session('resent'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Email Sent!',
                                text: 'A new verification link has been sent to your email address.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        </script>
                    @endif

                    <p class="mb-3">
                        {{ __('Before proceeding, please check your email for the verification link.') }}
                    </p>
                    
                    <p class="mb-4">
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" id="resendForm">
                            @csrf
                            <!-- Button to resend the verification email -->
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline resend-btn">
                                {{ __('click here to request another') }}
                            </button>.
                        </form>
                    </p>

                    <!-- Button to go back to the homepage -->
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3">
                        <i class="bi bi-house-door"></i> {{ __('Back to Home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add click event to the resend button
    document.querySelector('.resend-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent immediate form submission

        // Display a SweetAlert2 confirmation modal before resending the verification email
        Swal.fire({
            title: 'Resend Verification Email?',
            text: "A new link will be sent to your email.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, resend it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('resendForm').submit(); // Submit the form only if the user confirms
            }
        });
    });
});
</script>
@endsection
