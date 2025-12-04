<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EnviarCredenciales;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cliente;

class RegistroController extends Controller
{
    // Mostrar formulario de registro
    public function showRegistro()
    {
        return view('auth.registro');
    }

    // Registrar usuario + cliente
    public function registrar(Request $request)
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
                'correo'    => $request->email, // usa el mismo email del usuario
            ]);

            // Ligar usuario → cliente
            $user->cliente_id = $cliente->cliente_id;
            $user->save();

            Mail::to($request->email)->send(
                new EnviarCredenciales(
                    $cliente->nombre . ' ' . $cliente->apellido,
                    $request->email,
                    $request->password
                )
            );

            DB::commit();

            return redirect()->route('login')->with(
                'success',
                'Registro exitoso. Ya puedes iniciar sesión.'
            );
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error al registrar el cliente: ' . $e->getMessage()]);
        }
    }
}
