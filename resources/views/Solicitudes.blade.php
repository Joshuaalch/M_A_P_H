<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Usuarios</title>
    
    <!-- Estilos mejorados -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            overflow: hidden;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }

        .solicitud-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .solicitud-item {
            padding: 18px 24px;
            border-radius: 8px;
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .solicitud-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .solicitud-info {
            flex: 1;
            margin-right: 20px;
        }

        .solicitud-nombre {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        .solicitud-correo {
            font-size: 14px;
            color: #777;
        }

        .solicitud-estado {
            font-size: 14px;
            font-weight: bold;
            padding: 8px 14px;
            border-radius: 20px;
            text-transform: capitalize;
            text-align: center;
        }

        .estado-pendiente {
            background-color: #ffc107;
            color: #333;
        }

        .estado-aprobado {
            background-color: #28a745;
            color: #fff;
        }

        .estado-rechazado {
            background-color: #dc3545;
            color: #fff;
        }

        /* Mejorar responsividad */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .solicitud-item {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Solicitudes de Usuarios</h1>
        <ul class="solicitud-list">
            @foreach ($solicitudes as $solicitud)
                <li class="solicitud-item">
                    <div class="solicitud-info">
                        <div class="solicitud-nombre">{{ $solicitud->nombre }} {{ $solicitud->apellidos }}</div>
                        <div class="solicitud-correo">{{ $solicitud->correo }}</div>
                    </div>
                    <div class="solicitud-estado {{ $solicitud->estado === 'pendiente' ? 'estado-pendiente' : ($solicitud->estado === 'aprobado' ? 'estado-aprobado' : 'estado-rechazado') }}">
                        {{ ucfirst($solicitud->estado) }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
