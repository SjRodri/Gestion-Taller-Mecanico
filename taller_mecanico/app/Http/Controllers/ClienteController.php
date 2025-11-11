<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::leftJoin('vehiculos', 'clientes.cliente_id', '=', 'vehiculos.cliente_id')
            ->select(
                'clientes.cliente_id',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.telefono',
                'clientes.direccion',
                'clientes.correo',
                'clientes.dni',
                'vehiculos.matricula'
            )
            ->groupBy(
                'clientes.cliente_id',
                'clientes.nombre',
                'clientes.apellido',
                'clientes.telefono',
                'clientes.direccion',
                'clientes.correo',
                'clientes.dni',
                'vehiculos.matricula'
            )
            ->get();

        return view('clientes', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'nullable|string|max:50',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255|unique:clientes,correo',
        ]);

        // Insertar cliente
        DB::table('clientes')->insert([
            'dni' => $validated['dni'] ?? null,
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'telefono' => $validated['telefono'] ?? null,
            'direccion' => $validated['direccion'] ?? null,
            'correo' => $validated['correo'] ?? null,
        ]);

        return redirect('/clientes')->with('success', 'Cliente agregado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
