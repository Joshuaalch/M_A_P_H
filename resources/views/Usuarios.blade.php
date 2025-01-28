<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #e0eaf1);
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .btn-back {
            background: linear-gradient(135deg, #4a90e2, #357abd);
            border: none;
            color: #fff;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            transform: scale(1.05);
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .search-bar input {
            border-radius: 25px;
            padding: 8px 16px;
            border: 1px solid #e0e0e0;
            width: 100%;
            max-width: 250px;
            outline: none;
            font-size: 0.9rem;
        }

        .search-bar input:focus {
            border-color: #4a90e2;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 0.9rem;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .table thead {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn {
            border-radius: 5px;
            font-size: 0.8rem;
            padding: 6px 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-info {
            background: #2a5298;
            color: #fff;
        }

        .btn-warning {
            background: #f39c12;
            color: #fff;
        }

        .btn-danger {
            background: #e74c3c;
            color: #fff;
        }

        .btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .pagination button {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .pagination button:hover {
            transform: scale(1.1);
            background: #357abd;
        }

        .pagination button.active {
            background: #2a5298;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .table th, .table td {
                padding: 6px;
                font-size: 0.8rem;
            }

            .search-bar input {
                width: 200px;
            }

            .btn-back {
                width: 100%;
                padding: 10px;
            }

            .container {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .search-bar input {
                width: 150px;
            }

            .table th, .table td {
                padding: 5px;
                font-size: 0.7rem;
            }

            .pagination button {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Usuarios</h1>

        <button class="btn btn-back" onclick="window.location.href='/lobby'">Regresar al Lobby</button>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Buscar por nombre..." onkeyup="searchTable()">
        </div>

        <div class="table-responsive">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Tipo de Cédula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->cedula }}</td>
                        <td>{{ $usuario->tipo_cedula }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->correo }}</td>
                        <td>{{ $usuario->rol }}</td>
                        <td>{{ $usuario->estado }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-info">Ver</button>
                                <button class="btn btn-warning">Editar</button>
                                <button class="btn btn-danger">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination" id="pagination"></div>
    </div>

    <script>
        const rowsPerPage = 5;
        const table = document.getElementById('userTable');
        const pagination = document.getElementById('pagination');
        const rows = table.querySelectorAll('tbody tr');

        function displayRows(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = (index >= start && index < end) ? '' : 'none';
            });
        }

        function setupPagination() {
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            pagination.innerHTML = '';

            for (let i = 1; i <= pageCount; i++) {
                const button = document.createElement('button');
                button.textContent = i;
                button.addEventListener('click', () => {
                    displayRows(i);
                    document.querySelectorAll('.pagination button').forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });

                if (i === 1) button.classList.add('active');
                pagination.appendChild(button);
            }
        }

        function searchTable() {
            const input = document.getElementById("searchInput").value.toUpperCase();
            rows.forEach(row => {
                const nameCell = row.getElementsByTagName("td")[3];
                if (nameCell) {
                    const textValue = nameCell.textContent || nameCell.innerText;
                    row.style.display = textValue.toUpperCase().indexOf(input) > -1 ? "" : "none";
                }
            });
        }

        displayRows(1);
        setupPagination();
    </script>
</body>
</html>
