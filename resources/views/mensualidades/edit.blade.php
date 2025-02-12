@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Monthly Fee</h1>

    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('mensualidad.index', $mensualidad->id_cedula) }}" class="btn btn-outline-secondary">
            ← Back to Monthly Fees
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded">
                <div class="card-body">
                    <h5 class="card-title text-center">Update Monthly Fee</h5>

                    <!-- Show success message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form id="edit-form" action="{{ route('mensualidad.update', $mensualidad->id_mensualidad) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="{{ $mensualidad->fecha_inicio }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="fecha_fin" value="{{ $mensualidad->fecha_fin }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Monthly Fee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 for Confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('edit-form').addEventListener('submit', function(event) {
        event.preventDefault();
        let form = this;

        Swal.fire({
            title: 'Update this monthly fee?',
            text: "Please verify that the data is correct.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection
