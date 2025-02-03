@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Botón "Volver" en la esquina superior izquierda -->
    <a href="{{ url('/lobby') }}" class="btn btn-outline-secondary mb-3" style="position: absolute; top: 20px; left: 20px;">
        Volver
    </a>
    <title>Listado de Empresas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-action {
            margin-right: 10px;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gestión de Empresas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container">
        <h1 class="my-4">Listado de Empresas</h1>
        <a href="{{ route('empresas.create') }}" class="btn btn-success mb-3">Crear Nueva Empresa</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Tipo de Cédula</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
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
                            <div class="d-flex justify-content-start">
                                <a href="{{ route('empresas.show', $empresa->id_empresa) }}" class="btn btn-info btn-action">Ver</a>
                                <a href="{{ route('empresas.edit', $empresa->id_empresa) }}" class="btn btn-primary btn-action">Editar</a>
                                <form action="{{ route('empresas.destroy', $empresa->id_empresa) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-action">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
@endsection
