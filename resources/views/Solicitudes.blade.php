<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Usuarios</title>
    <!-- Estilos minimalistas -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .solicitud-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .solicitud-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .solicitud-item:last-child {
            border-bottom: none;
        }
        .solicitud-info {
            flex: 1;
        }
        .solicitud-nombre {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        .solicitud-correo {
            font-size: 14px;
            color: #666;
        }
        .solicitud-estado {
            font-size: 14px;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .estado-pendiente {
            background-color: #ffc107; /* Amarillo para pendiente */
            color: #333;
        }
        .estado-aprobado {
            background-color: #28a745; /* Verde para aprobado */
            color: #fff;
        }
        .estado-rechazado {
            background-color: #dc3545; /* Rojo para rechazado */
            color: #fff;
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