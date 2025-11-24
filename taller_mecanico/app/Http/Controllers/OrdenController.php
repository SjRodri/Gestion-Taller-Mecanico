<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Cliente;
use App\Models\Taller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    // LISTADO
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');

        $ordenes = Orden::query()
            ->when($buscar, function ($q) use ($buscar) {
                $q->where('descripcion_orden', 'LIKE', "%$buscar%")
                    ->orWhere('orden_id', 'LIKE', "%$buscar%");
            })
            ->when($estado, function ($q) use ($estado) {
                $q->where('estado', $estado);
            })
            ->orderBy('orden_id', 'DESC')
            ->paginate(12)
            ->appends($request->query());

        return view('ordenes.index', compact('ordenes', 'buscar', 'estado'));
    }

    // FORM CREAR
    public function create()
    {
        $clientes = Cliente::all();
        $talleres = Taller::all();
        $vehiculos = Vehiculo::all();

        return view('ordenes.create', compact('clientes', 'talleres', 'vehiculos'));
    }

    // GUARDAR NUEVA ORDEN
    public function store(Request $request)
    {
        $request->validate([
            'descripcion_orden' => 'required',
            'cliente_id' => 'required',
            'fecha' => 'required|date'
        ]);

        Orden::create($request->all());

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden creada correctamente.');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $orden = Orden::findOrFail($id);

        $clientes = Cliente::all();
        $talleres = Taller::all();
        $vehiculos = Vehiculo::all();

        return view('ordenes.edit', compact('orden', 'clientes', 'talleres', 'vehiculos'));
    }

    // ACTUALIZAR ORDEN
    public function update(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);

        $orden->update($request->all());

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden actualizada correctamente.');
    }

    // ELIMINAR → SOLO CAMBIA ESTADO
    public function destroy(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);

        // Validar selección
        $request->validate([
            'motivo' => 'required|in:cancelada,finalizada'
        ]);

        // Solo cambia el estado
        $orden->estado = $request->motivo;
        $orden->save();

        return redirect()->route('ordenes.index')
            ->with('success', 'La orden fue marcada como ' . $request->motivo);
    }
}
