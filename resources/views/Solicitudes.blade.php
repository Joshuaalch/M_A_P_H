@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Solicitudes de Usuarios</h1>

    <div class="mb-3 d-flex justify-content-center">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Buscar por nombre..." onkeyup="filtrarSolicitudes()">
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="solicitudList">
                @foreach ($solicitudes as $solicitud)
                    <tr class="solicitud-item">
                        <td class="solicitud-nombre">{{ $solicitud->nombre }} {{ $solicitud->apellidos }}</td>
                        <td class="solicitud-correo">{{ $solicitud->correo }}</td>
                        <td>
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
    function filtrarSolicitudes() {
        let filtro = document.getElementById('searchInput').value.toLowerCase();
        let filas = document.querySelectorAll('.solicitud-item');

        filas.forEach(fila => {
            let nombre = fila.querySelector('.solicitud-nombre').textContent.toLowerCase();
            fila.style.display = nombre.includes(filtro) ? "" : "none";
        });
    }
</script>
@endsection
