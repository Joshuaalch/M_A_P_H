<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index()
    {
        // Simular datos de solicitudes
        $solicitudes = [
            (object) [
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'correo' => 'juan.perez@example.com',
                'estado' => 'pendiente',
            ],
            (object) [
                'nombre' => 'Ana',
                'apellidos' => 'Gómez',
                'correo' => 'ana.gomez@example.com',
                'estado' => 'aprobado',
            ],
            (object) [
                'nombre' => 'Carlos',
                'apellidos' => 'López',
                'correo' => 'carlos.lopez@example.com',
                'estado' => 'rechazado',
            ],
        ];

        // Pasar los datos a la vista
        return view('solicitudes', compact('solicitudes'));
    }
}