@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient text-white text-center py-4 rounded-top" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
                    <h2 class="fw-bold">Detalles de la Empresa</h2>
                </div>
                
                <div class="card-body p-5">
                    <h4 class="fw-bold text-primary">{{ $empresa->nombre }}</h4>
                    <hr>
                    <p class="card-text"><strong>Cédula:</strong> {{ $empresa->cedula }}</p>
                    <p class="card-text"><strong>Tipo de Cédula:</strong> {{ $empresa->tipo_cedula }}</p>
                    <p class="card-text"><strong>Teléfono:</strong> {{ $empresa->telefono }}</p>
                    <p class="card-text"><strong>Correo:</strong> {{ $empresa->correo }}</p>
                    <p class="card-text"><strong>Estado:</strong>
                        <span class="badge {{ $empresa->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ $empresa->estado }}
                        </span>
                    </p>

                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-outline-primary shadow-sm px-4 py-2">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <button class="btn btn-outline-danger shadow-sm px-4 py-2 delete-empresa" data-id="{{ $empresa->id_empresa }}">
                            <i class="bi bi-trash-fill"></i> Eliminar
                        </button>
                    </div>

                    <!-- Formulario oculto para eliminación -->
                    <form id="delete-form-{{ $empresa->id_empresa }}" action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.delete-empresa').addEventListener('click', function () {
        let empresaId = this.getAttribute('data-id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + empresaId).submit();
            }
        });
    });
});
</script>
@endsection
