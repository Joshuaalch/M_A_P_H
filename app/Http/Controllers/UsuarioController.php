<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empresa;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioCorreo;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Obtenemos todos los usuarios y la relación con la empresa
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

   
    public function sendEmail(Request $request, $id_cedula)
    {
        $usuario = Usuario::where('id_cedula', $id_cedula)->firstOrFail();
    
        // Validar los datos
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachments.*' => 'file|max:2048', // Tamaño máximo de 2 MB por archivo
        ]);
    
        $attachments = $request->file('attachments'); // Obtener los archivos subidos
    
        // Crear instancia del Mailable y adjuntar los archivos
        $email = new UsuarioCorreo($usuario, $request->subject, $request->message);
    
        if ($attachments) {
            foreach ($attachments as $file) {
                $email->attach($file->getPathname(), [
                    'as' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                ]);
            }
        }
    
        // Enviar el correo
        Mail::to($usuario->correo)->send($email);
    
        // Mensaje de éxito
        session()->flash('success', 'Correo enviado con éxito a ' . $usuario->nombre);
    
        return redirect()->route('usuarios.index');
    }
 }
