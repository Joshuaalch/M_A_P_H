<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('empresa')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $empresas = Empresa::all();
        return view('usuarios.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cedula' => 'required|unique:tbusuario',
            'tipo_cedula' => 'required',
            'id_empresa' => 'required|exists:tbempresa,id_empresa',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique:tbusuario',
            'contrasena' => 'required',
            'rol' => 'required',
            'estado' => 'required',
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show($id)
    {
        $usuario = Usuario::with('empresa')->findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $empresas = Empresa::all();
        return view('usuarios.edit', compact('usuario', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_cedula' => 'required',
            'id_empresa' => 'required|exists:tbempresa,id_empresa',
            'nombre' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email|unique:tbusuario,correo,' . $id . ',id_cedula',
            'contrasena' => 'nullable',
            'rol' => 'required',
            'estado' => 'required',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}