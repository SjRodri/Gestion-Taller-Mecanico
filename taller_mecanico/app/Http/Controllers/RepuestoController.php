<?php

namespace App\Http\Controllers;

use App\Models\Repuesto;
use Illuminate\Http\Request;

class RepuestoController extends Controller
{
    /**
     * Mostrar listado de repuestos.
     */
    public function index()
    {
        $repuestos = Repuesto::orderBy('repuesto_id', 'asc')->get();

        return view('repuestos.index', compact('repuestos'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('repuestos.create');
    }

    /**
     * Guardar un nuevo repuesto.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion_repuesto' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'reorder_threshold' => 'nullable|integer|min:0',
        ]);

        Repuesto::create($validated);

        return redirect()->route('repuestos.index')
            ->with('success', 'Repuesto agregado correctamente.');
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Repuesto $repuesto)
    {
        return view('repuestos.edit', compact('repuesto'));
    }

    /**
     * Actualizar un repuesto existente.
     */
    public function update(Request $request, Repuesto $repuesto)
    {
        $validated = $request->validate([
            'descripcion_repuesto' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'reorder_threshold' => 'nullable|integer|min:0',
        ]);

        $repuesto->update($validated);

        return redirect()->route('repuestos.index')
            ->with('success', 'Repuesto actualizado correctamente.');
    }

    /**
     * Eliminar un repuesto.
     */
    public function destroy(Repuesto $repuesto)
    {
        $repuesto->delete();

        return redirect()->route('repuestos.index')
            ->with('success', 'Repuesto eliminado correctamente.');
    }
}
