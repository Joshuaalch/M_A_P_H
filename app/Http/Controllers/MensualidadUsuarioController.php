<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensualidadUsuario;
use App\Models\Usuario;

class MensualidadUsuarioController extends Controller
{
    // Mostrar todas las mensualidades de un usuario
    public function index($id_cedula)
    {
        $usuario = Usuario::where('id_cedula', $id_cedula)->firstOrFail();
        $mensualidades = MensualidadUsuario::where('id_cedula', $id_cedula)->get();
        return view('mensualidades.index', compact('usuario', 'mensualidades'));
    }

    // Guardar una nueva mensualidad
    public function store(Request $request)
    {
        $request->validate([
            'id_cedula' => 'required|exists:tbusuario,id_cedula',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
        ]);

        MensualidadUsuario::create([
            'id_cedula' => $request->id_cedula,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => 1,
        ]);

        return redirect()->route('mensualidad.index', $request->id_cedula)->with('success', 'Mensualidad asignada con éxito');
    }

    // Eliminar una mensualidad
    public function destroy($id)
    {
        $mensualidad = MensualidadUsuario::findOrFail($id);
        $id_cedula = $mensualidad->id_cedula;
        $mensualidad->delete();

        return redirect()->route('mensualidad.index', $id_cedula)->with('success', 'Mensualidad eliminada con éxito');
    }

    public function edit($id)
{
    $mensualidad = MensualidadUsuario::findOrFail($id);
    return view('mensualidades.edit', compact('mensualidad'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after:fecha_inicio',
    ]);

    $mensualidad = MensualidadUsuario::findOrFail($id);
    $mensualidad->update([
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
    ]);

    return redirect()->route('mensualidad.index', $mensualidad->id_cedula)->with('success', 'Mensualidad actualizada con éxito.');
}
}
