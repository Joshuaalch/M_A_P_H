@extends('layouts.app')
@push('styles')
    <!-- Include custom styles for the user edit page -->
    @vite(['resources/css/userEdit.css'])
@endpush

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <!-- Profile edit page title -->
                    <h2 class="fw-bold">Edit Profile</h2>
                </div>
                
                <div class="card-body p-5">
                    <!-- Check if there is a success message and show a SweetAlert -->
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

                    <!-- Form to update profile information -->
                    <form action="{{ route('profile.update') }}" method="POST" id="editarPerfilForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <!-- Input field for name -->
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input id="name" type="text" class="form-control p-3 shadow-sm @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required placeholder="Enter your name">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <!-- Input field for email -->
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input id="email" type="email" class="form-control p-3 shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required placeholder="Enter your email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <!-- Input field for password (optional) -->
                            <label for="password" class="form-label fw-semibold">New Password (optional)</label>
                            <input id="password" type="password" class="form-control p-3 shadow-sm @error('password') is-invalid @enderror" name="password" placeholder="Enter your new password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <!-- Input field to confirm the new password -->
                            <label for="password-confirm" class="form-label fw-semibold">Confirm New Password</label>
                            <input id="password-confirm" type="password" class="form-control p-3 shadow-sm" name="password_confirmation" placeholder="Confirm your new password">
                        </div>

                        <div class="d-grid">
                            <!-- Submit button to save changes -->
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm fw-bold" id="guardarBtn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Handle form submission with confirmation dialog
    document.getElementById('editarPerfilForm').addEventListener('submit', function (event) {
        event.preventDefault();

        // Show a SweetAlert confirmation before submitting the form
        Swal.fire({
            title: 'Save profile changes?',
            text: "Make sure the information is correct",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            // If confirmed, submit the form
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
</script>
@endsection
