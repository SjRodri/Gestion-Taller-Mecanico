<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\EnviarCredenciales;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    /* LISTAR */
    public function index(Request $request)
    {
        $query = Cliente::leftJoin('vehiculos', 'clientes.cliente_id', '=', 'vehiculos.cliente_id')
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
            );

        // FILTRO DE BÚSQUEDA
        if ($request->filled('buscar')) {
            $buscar = $request->buscar;

            $query->where(function ($q) use ($buscar) {
                $q->where('clientes.nombre', 'like', "%$buscar%")
                    ->orWhere('clientes.apellido', 'like', "%$buscar%")
                    ->orWhere('clientes.dni', 'like', "%$buscar%")
                    ->orWhere('clientes.telefono', 'like', "%$buscar%");
            });
        }

        // ORDEN + PAGINACIÓN
        $clientes = $query->orderBy('clientes.cliente_id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('clientes.index', compact('clientes'));
    }

    /* FORMULARIO CREAR */
    public function create()
    {
        return view('clientes.create');
    }

    /* GUARDAR CLIENTE */
    public function store(Request $request)
    {
        $request->validate([
            'dni'       => 'nullable|string|numeric|digits_between:1,13|unique:clientes,dni',
            'nombre'    => 'required|string|max:100',
            'apellido'  => 'required|string|max:100',
            'telefono'  => 'nullable|numeric|digits_between:1,8|unique:clientes,telefono',
            'direccion' => 'nullable|string|max:255',
            'email'     => 'required|email|unique:usuarios,email|unique:clientes,correo',
            'password'  => 'required|min:6',
        ]);

        DB::beginTransaction();

        try {

            // Crear usuario tipo cliente
            $user = User::create([
                'email'         => $request->email,
                'password_hash' => Hash::make($request->password),
                'rol'           => 'cliente',
                'activo'        => 1,
            ]);

            // Crear cliente
            $cliente = Cliente::create([
                'dni'       => $request->dni,
                'nombre'    => $request->nombre,
                'apellido'  => $request->apellido,
                'telefono'  => $request->telefono,
                'direccion' => $request->direccion,
                'correo'    => $request->email,
            ]);

            // Asociar usuario → cliente
            $user->cliente_id = $cliente->cliente_id;
            $user->save();

            // Enviar correo con credenciales
            Mail::to($request->email)->send(
                new EnviarCredenciales(
                    $cliente->nombre . ' ' . $cliente->apellido,
                    $request->email,
                    $request->password
                )
            );

            DB::commit();

            return redirect('/clientes')->with('success', 'Cliente y usuario creados correctamente');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors(['error' => 'Hubo un problema al crear el cliente: ' . $e->getMessage()]);
        }
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
