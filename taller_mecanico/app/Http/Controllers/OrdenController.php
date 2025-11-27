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
        $fecha  = $request->input('fecha'); // <-- FILTRO NUEVO
        $taller_id = $request->input('taller_id'); // <-- FILTRO NUEVO
        $vehiculo_id = $request->input('vehiculo_id'); // <-- FILTRO NUEVO

        $talleres = Taller::all();
        $vehiculos = Vehiculo::all();

        $ordenes = Orden::query()
            ->when($buscar, function ($q) use ($buscar) {
                $q->where('descripcion_orden', 'LIKE', "%$buscar%")
                  ->orWhere('orden_id', 'LIKE', "%$buscar%");
            })
            ->when($estado, function ($q) use ($estado) {
                $q->where('estado', $estado);
            })
            ->when($fecha, function ($q) use ($fecha) {
                $q->whereDate('fecha', $fecha);
            })
            ->when($taller_id, function ($q) use ($taller_id) {
                $q->where('taller_id', $taller_id);
            })
            ->when($vehiculo_id, function ($q) use ($vehiculo_id) {
                $q->where('vehiculo_id', $vehiculo_id);
            })
            ->orderBy('orden_id', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        return view('ordenes.index', compact('ordenes', 'buscar', 'estado', 'fecha', 'talleres', 'taller_id', 'vehiculos', 'vehiculo_id'));
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
            'fecha' => 'required|date|before_or_equal:today',
            'taller_id' => 'required'
        ]);

        // 🛑 VALIDACIÓN MAX 8 ÓRDENES ACTIVAS POR TALLER
        $ordenesActivas = Orden::where('taller_id', $request->taller_id)
            ->where('estado', 'activa')
            ->count();

        if ($ordenesActivas >= 8) {
            return back()
                ->withErrors(['taller_id' => 'Este taller ya tiene 8 órdenes activas.'])
                ->withInput();
        }

        Orden::create([
            'descripcion_orden' => $request->descripcion_orden,
            'cliente_id' => $request->cliente_id,
            'taller_id' => $request->taller_id,
            'vehiculo_id' => $request->vehiculo_id,
            'fecha' => $request->fecha,
            'estado' => 'activa'
        ]);

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
        $request->validate([
            'descripcion_orden' => 'required',
            'cliente_id' => 'required',
            'fecha' => 'required|date|before_or_equal:today',
            'estado' => 'required',
            'taller_id' => 'required'
        ]);

        $orden = Orden::findOrFail($id);

        // 🛑 VALIDACIÓN MAX 8 ÓRDENES ACTIVAS POR TALLER (solo si sigue activa)
        if ($request->estado === 'activa') {

            $ordenesActivas = Orden::where('taller_id', $request->taller_id)
                ->where('estado', 'activa')
                ->where('orden_id', '!=', $id)
                ->count();

            if ($ordenesActivas >= 8) {
                return back()
                    ->withErrors(['taller_id' => 'Este taller ya tiene 8 órdenes activas.'])
                    ->withInput();
            }
        }

        $orden->update([
            'descripcion_orden' => $request->descripcion_orden,
            'cliente_id' => $request->cliente_id,
            'taller_id' => $request->taller_id,
            'vehiculo_id' => $request->vehiculo_id,
            'fecha' => $request->fecha,
            'estado' => $request->estado
        ]);

        return redirect()->route('ordenes.index')
            ->with('success', 'Orden actualizada correctamente.');
    }

    // ELIMINAR → SOLO CAMBIA ESTADO (FINALIZADA o CANCELADA)
    public function destroy(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);

        $request->validate([
            'estado_final' => 'required|in:cancelada,finalizada'
        ]);

        $orden->estado = $request->estado_final;
        $orden->save();

        return redirect()->route('ordenes.index')
            ->with('success', 'La orden fue marcada como ' . $request->estado_final);
    }
}
