<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Cliente;
use App\Models\Taller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenController extends Controller
{
    // LISTADO
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');
        $fecha  = $request->input('fecha');
        $taller_id = $request->input('taller_id');
        $vehiculo_id = $request->input('vehiculo_id');

        $talleres = Taller::all();
        $vehiculos = Vehiculo::all();

        // Base de consulta
        $ordenes = Orden::query()
            ->when($buscar, function ($q) use ($buscar) {
                $q->where('descripcion_orden', 'LIKE', "%$buscar%")
                    ->orWhere('orden_id', 'LIKE', "%$buscar%");
            })
            ->when($estado, fn($q) => $q->where('estado', $estado))
            ->when($fecha, fn($q) => $q->whereDate('fecha', $fecha))
            ->when($taller_id, fn($q) => $q->where('taller_id', $taller_id))
            ->when($vehiculo_id, fn($q) => $q->where('vehiculo_id', $vehiculo_id));

        // FILTRO PARA CLIENTE (si está autenticado y su rol es 'cliente')
        if (Auth::check() && Auth::user()->rol === 'cliente') {
            $clienteId = Auth::user()->cliente_id;
            // Seguridad: si por alguna razón no tiene cliente_id, devolvemos vacío
            if ($clienteId) {
                $ordenes->where('cliente_id', $clienteId);
            } else {
                // Force empty result set
                $ordenes->whereRaw('1 = 0');
            }
        }

        // Finalizar consulta
        $ordenes = $ordenes->orderBy('orden_id', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        return view('ordenes.index', compact(
            'ordenes',
            'buscar',
            'estado',
            'fecha',
            'talleres',
            'taller_id',
            'vehiculos',
            'vehiculo_id'
        ));
    }

    // FORM CREAR
    public function create()
    {
        // Si hay un usuario autenticado y es cliente -> limitar clientes
        if (Auth::check() && Auth::user()->rol === 'cliente') {

            $user = Auth::user();

            // Obtener el cliente vinculado al usuario
            $cliente = null;
            if (!empty($user->cliente_id)) {
                $cliente = Cliente::find($user->cliente_id);
            }

            // Si no se encuentra el cliente, enviar una colección vacía (evita errores en la vista)
            $clientes = $cliente ? collect([$cliente]) : collect();

            // Vehículos
            $vehiculos = Vehiculo::all();
        } else {
            // Admin y Empleado ven todo
            $clientes = Cliente::all();
            $vehiculos = Vehiculo::all();
        }

        // Talleres visibles para todos
        $talleres = Taller::all();

        return view('ordenes.create', compact('clientes', 'talleres', 'vehiculos'));
    }

    // GUARDAR NUEVA ORDEN
    public function store(Request $request)
    {
        $request->validate([
            'descripcion_orden' => 'required',
            'cliente_id' => 'required',
            'fecha' => 'required|date|after_or_equal:today',
            'taller_id' => 'required'
        ]);

        // Si el usuario autenticado es cliente, forzamos que la orden use su cliente_id
        if (Auth::check() && Auth::user()->rol === 'cliente') {
            $user = Auth::user();

            if (empty($user->cliente_id)) {
                return back()->with('error', 'No se pudo identificar tu perfil de cliente.');
            }

            // Reemplazamos el cliente_id enviado por el del usuario autenticado
            $request->merge(['cliente_id' => $user->cliente_id]);
        }

        // Validación: máximo 100 órdenes por taller y fecha
        $ordenesPorTallerYFecha = Orden::where('taller_id', $request->taller_id)
            ->whereDate('fecha', $request->fecha)
            ->whereIn('estado', ['activa', 'espera', 'finalizada'])
            ->count();

        if ($ordenesPorTallerYFecha >= 100) {
            return redirect()->route('ordenes.index')
                ->with('error', 'Este taller ya alcanzó el límite de 100 órdenes para esta fecha.');
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

        // 🚫 Validación: evitar acceso a órdenes de otros clientes
        if (Auth::user()->rol === 'cliente' && $orden->cliente_id !== Auth::user()->cliente_id) {
            return redirect()->route('ordenes.index')
                ->with('error', 'No tienes permiso para acceder a esta orden.');
        }

        // Si hay un usuario autenticado y es cliente -> limitar clientes
        if (Auth::check() && Auth::user()->rol === 'cliente') {

            $user = Auth::user();

            // Obtener el cliente vinculado al usuario
            $cliente = null;
            if (!empty($user->cliente_id)) {
                $cliente = Cliente::find($user->cliente_id);
            }

            // Si no se encuentra el cliente, enviar una colección vacía
            $clientes = $cliente ? collect([$cliente]) : collect();

            // Vehículos (si quiere restringir, debe filtrar aquí)
            $vehiculos = Vehiculo::all();
        } else {
            // Admin y Empleado ven todo
            $clientes = Cliente::all();
            $vehiculos = Vehiculo::all();
        }

        // Talleres visibles para todos
        $talleres = Taller::all();

        // Bloqueo si ya está finalizada o cancelada
        if (in_array($orden->estado, ['finalizada', 'cancelada'])) {
            return redirect()->route('ordenes.index')
                ->with('error', 'No puedes editar una orden finalizada o cancelada.');
        }

        return view('ordenes.edit', compact('orden', 'clientes', 'talleres', 'vehiculos'));
    }

    // ACTUALIZAR ORDEN
    public function update(Request $request, $id)
    {
        $orden = Orden::findOrFail($id);

        // 🚫 Validación: evitar actualización de órdenes de otros clientes
        if (Auth::user()->rol === 'cliente' && $orden->cliente_id !== Auth::user()->cliente_id) {
            return redirect()->route('ordenes.index')
                ->with('error', 'No tienes permiso para modificar esta orden.');
        }

        // Bloqueo si ya está finalizada o cancelada
        if (in_array($orden->estado, ['finalizada', 'cancelada'])) {
            return redirect()->route('ordenes.index')
                ->with('error', 'No puedes actualizar una orden finalizada o cancelada.');
        }

        $request->validate([
            'descripcion_orden' => 'required',
            'cliente_id' => 'required',
            'fecha' => 'required|date|after_or_equal:today',
            'estado' => 'required',
            'taller_id' => 'required'
        ]);

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


    // ELIMINAR → SOLO CAMBIA ESTADO
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
