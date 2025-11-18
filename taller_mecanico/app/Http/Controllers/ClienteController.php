<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /* LISTAR */
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

        return view('clientes.index', ['clientes' => $clientes]);
    }

    /* FORMULARIO CREAR */
    public function create()
    {
        return view('clientes.create');
    }

    /* GUARDAR CLIENTE */
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

        DB::table('clientes')->insert($validated);

        return redirect('/clientes')->with('success', 'Cliente agregado correctamente');
    }

    /* FORMULARIO EDITAR */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /* ACTUALIZAR CLIENTE */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'dni' => 'nullable|string|max:50',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'nullable|string|max:50',
            'direccion' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255|unique:clientes,correo,' . $cliente->cliente_id . ',cliente_id',
        ]);

        $cliente->update($validated);

        return redirect('/clientes')->with('success', 'Cliente actualizado correctamente');
    }

    /* ELIMINAR CLIENTE */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect('/clientes')->with('success', 'Cliente eliminado');
    }
}
