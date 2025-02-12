@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">User Requests</h1>

    <!-- Search Input for Filtering Requests -->
    <div class="mb-3 d-flex justify-content-center">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search by name..." onkeyup="filtrarSolicitudes()">
    </div>

    <!-- Table to Display Requests -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="solicitudList">
                <!-- Loop through the solicitudes (requests) and display each one in a row -->
                @foreach ($solicitudes as $solicitud)
                    <tr class="solicitud-item">
                        <td class="solicitud-nombre">{{ $solicitud->nombre }} {{ $solicitud->apellidos }}</td>
                        <td class="solicitud-correo">{{ $solicitud->correo }}</td>
                        <td>
                            <!-- Badge that indicates the request status (pending, approved, or rejected) -->
                            <span class="badge {{ $solicitud->estado === 'pendiente' ? 'bg-warning text-dark' : ($solicitud->estado === 'aprobado' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($solicitud->estado) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Function to filter the requests based on the input text
    function filtrarSolicitudes() {
        let filtro = document.getElementById('searchInput').value.toLowerCase();  // Get the search input value
        let filas = document.querySelectorAll('.solicitud-item');  // Select all rows of the table

        filas.forEach(fila => {
            let nombre = fila.querySelector('.solicitud-nombre').textContent.toLowerCase();  // Get the name from each row
            // Show or hide rows based on whether the name includes the search filter
            fila.style.display = nombre.includes(filtro) ? "" : "none";
        });
    }
</script>
@endsection
