<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Importa el modelo Usuario
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Método para mostrar la lista de usuarios
    public function index()
    {
        // Obtener todos los usuarios, incluyendo la relación con la empresa
        $usuarios = Usuario::with('empresa')->get();  // Relación con 'empresa'
        
        // Pasar los datos a la vista
        return view('Usuarios', compact('usuarios'));
    }

    // Método para mostrar el formulario de creación de usuarios
    public function create()
    {
        return view('usuarios.create');
    }

    // Método para almacenar un nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validatedData = $request->validate([
            'id_cedula' => 'required|unique:usuarios,id_cedula',
            'tipo_cedula' => 'required',
            'empresa_id' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'rol' => 'required',
            'estado' => 'required|boolean',
        ]);

        // Crear un nuevo usuario
        Usuario::create($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente');
    }

    // Método para mostrar un usuario específico
    public function show($id)
    {
        // Obtener el usuario por su ID y la relación con la empresa
        $usuario = Usuario::with('empresa')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Método para mostrar el formulario de edición de un usuario
    public function edit($id)
    {
        // Obtener el usuario por su ID
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Método para actualizar un usuario
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos
        $validatedData = $request->validate([
            'id_cedula' => 'required|unique:usuarios,id_cedula,' . $id,
            'tipo_cedula' => 'required',
            'empresa_id' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'rol' => 'required',
            'estado' => 'required|boolean',
        ]);

        // Buscar el usuario por su ID
        $usuario = Usuario::findOrFail($id);
        // Actualizar los datos del usuario
        $usuario->update($validatedData);

        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    // Método para eliminar un usuario
    public function destroy($id)
    {
        // Buscar el usuario por su ID
        $usuario = Usuario::findOrFail($id);
        // Eliminar al usuario
        $usuario->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
