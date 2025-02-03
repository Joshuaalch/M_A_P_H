@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ url('/lobby') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <h1 class="text-center flex-grow-1">Empresas</h1>
        <a href="{{ route('empresas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Nueva Empresa
        </a>
    </div>
    
    <div class="mb-3 d-flex justify-content-center">
        <div class="input-group w-50">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o cédula...">
        </div>
    </div>
    
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Tipo</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="empresaTable">
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->nombre }}</td>
                        <td>{{ $empresa->cedula }}</td>
                        <td>{{ $empresa->tipo_cedula }}</td>
                        <td>{{ $empresa->telefono }}</td>
                        <td>{{ $empresa->correo }}</td>
                        <td>
                            <span class="badge {{ $empresa->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                {{ $empresa->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('empresas.show', $empresa->id_empresa) }}" class="btn btn-outline-info btn-sm" title="Ver Detalles">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta empresa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#empresaTable tr');
    
    rows.forEach(row => {
        let name = row.cells[0].textContent.toLowerCase();
        let cedula = row.cells[1].textContent.toLowerCase();
        row.style.display = name.includes(filter) || cedula.includes(filter) ? '' : 'none';
    });
});
</script>
@endsection
