<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Generar un nuevo ID si no se proporciona
        $nuevoId = Empresa::max('id_empresa') + 1; // Obtiene el último ID y suma 1
    
        $request->merge(['id_empresa' => $nuevoId]);
    
        $request->validate([
            'id_empresa' => 'required|integer|unique:tbempresa,id_empresa',
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:tbempresa,cedula',
            'tipo_cedula' => 'required|in:FI,JU',
            'telefono' => 'required|string|max:20|regex:/^[0-9]+$/',
            'correo' => 'required|email|max:255|unique:tbempresa,correo',
            'estado' => 'required|boolean',
        ]);
    
        Empresa::create($request->all());
    
        return redirect()->route('empresas.index')->with('success', 'Empresa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'tipo_cedula' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
            'estado' => 'required',
        ]);

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
                         ->with('success', 'Empresa actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')
                         ->with('success', 'Empresa eliminada exitosamente.');
    }
}