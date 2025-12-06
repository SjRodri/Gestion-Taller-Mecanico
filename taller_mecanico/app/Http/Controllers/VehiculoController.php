<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Mostrar listado de vehículos con filtros y datos necesarios para la vista.
     */
    public function index(Request $request)
    {
        $buscar  = $request->input('buscar');
        $cliente = $request->input('cliente');
        $ano     = $request->input('ano');

        // Consulta principal con relación cliente
        $query = Vehiculo::with('cliente');

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('modelo', 'LIKE', "%{$buscar}%")
                    ->orWhere('matricula', 'LIKE', "%{$buscar}%")
                    ->orWhere('color', 'LIKE', "%{$buscar}%")
                    ->orWhere('vin', 'LIKE', "%{$buscar}%");
            });
        }

        if ($cliente) {
            $query->where('cliente_id', $cliente);
        }

        if ($ano) {
            $query->where('ano', $ano);
        }

        $vehiculos = $query->orderBy('matricula')->paginate(10)
            ->appends($request->only(['buscar', 'cliente', 'ano']));

        // Datos para selects en la vista
        $clientes = Cliente::orderBy('nombre')->get();

        // Obtener años distintos (sin null), ordenados desc
        $anos = Vehiculo::whereNotNull('ano')
            ->distinct()
            ->orderBy('ano', 'desc')
            ->pluck('ano');

        return view(
            'vehiculos.index',
            compact('vehiculos', 'clientes', 'anos', 'buscar', 'cliente', 'ano')
        );
    }

    /**
     * Mostrar formulario de creación (envía lista de clientes para seleccionar propietario).
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('vehiculos.create', compact('clientes'));
    }

    /**
     * Guardar nuevo vehículo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula'  => 'required|string|max:50|unique:vehiculos,matricula',
            'modelo'     => 'required|string|max:100',
            'ano'        => 'nullable|integer|min:1900|max:2099',
            'color'      => 'nullable|string|max:50',
            'vin'        => 'nullable|string|max:50',
            'cliente_id' => 'nullable|integer|exists:clientes,cliente_id',
        ]);

        Vehiculo::create([
            'matricula'  => $request->matricula,
            'modelo'     => $request->modelo,
            'ano'        => $request->ano,
            'color'      => $request->color,
            'vin'        => $request->vin,
            'cliente_id' => $request->cliente_id ?? null,
        ]);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }

    public function edit(Vehiculo $vehiculo)
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('vehiculos.edit', compact('vehiculo', 'clientes'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'matricula'  => 'required|string|max:50|unique:vehiculos,matricula,' . $vehiculo->vehiculo_id . ',vehiculo_id',
            'modelo'     => 'required|string|max:100',
            'ano'        => 'nullable|integer|min:1900|max:2099',
            'color'      => 'nullable|string|max:50',
            'vin'        => 'nullable|string|max:50',
            'cliente_id' => 'nullable|integer|exists:clientes,cliente_id',
        ]);

        $vehiculo->update([
            'matricula'  => $request->matricula,
            'modelo'     => $request->modelo,
            'ano'        => $request->ano,
            'color'      => $request->color,
            'vin'        => $request->vin,
            'cliente_id' => $request->cliente_id ?? null,
        ]);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente.');
    }
}
