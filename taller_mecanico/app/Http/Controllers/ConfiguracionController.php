<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    // MOSTRAR LISTA
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('configuracion.index', compact('configuraciones'))
               ->with('seccion', 'configuracion'); // Para ocultar bloques del dashboard
    }

    // FORMULARIO DE CREACIÓN
    public function create()
    {
        return view('configuracion.create')
               ->with('seccion', 'configuracion'); // Para ocultar bloques del dashboard
    }

    // GUARDAR NUEVA CONFIGURACIÓN
    public function store(Request $request)
    {
        $request->validate([
            'clave' => 'required|max:255|unique:configuracion,clave',
            'valor' => 'required|max:255',
            'descripcion' => 'nullable|max:500'
        ]);

        Configuracion::create([
            'clave' => $request->clave,
            'valor' => $request->valor,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('configuracion.index')
                         ->with('success', 'Configuración creada correctamente.');
    }

    // FORMULARIO DE EDICIÓN
    public function edit($id)
    {
        $config = Configuracion::findOrFail($id);
        return view('configuracion.edit', compact('config'))
               ->with('seccion', 'configuracion');
    }

    // GUARDAR CAMBIOS
    public function update(Request $request, $id)
    {
        $config = Configuracion::findOrFail($id);

        $request->validate([
            'valor' => 'required|max:255',
            'descripcion' => 'nullable|max:500'
        ]);

        $config->valor = $request->valor;
        $config->descripcion = $request->descripcion ?? $config->descripcion;
        $config->save();

        return redirect()->route('configuracion.index')
                         ->with('success', 'Configuración actualizada correctamente.');
    }

    // ELIMINAR CONFIGURACIÓN
    public function destroy($id)
    {
        $config = Configuracion::findOrFail($id);
        $config->delete();

        return redirect()->route('configuracion.index')
                         ->with('success', 'Configuración eliminada correctamente.');
    }
}
