<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Mail\NuevoEmpleadoPendiente;
use Illuminate\Support\Facades\Mail;

class RegistroController extends Controller
{
    // Mostrar formulario de registro
    public function showRegistro()
    {
        return view('auth.registro');
    }

    // Procesar registro
    public function registrar(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'rol'      => 'required|in:cliente,empleado',
            'puesto'   => 'nullable|string|max:150',
        ]);

        $rol = $request->rol;

        // Crear usuario
        $user = User::create([
            'email'         => $request->email,
            'password_hash' => Hash::make($request->password),
            'rol'           => $rol,
            'activo'        => $rol === 'cliente' ? 1 : 0, // empleados quedan pendientes
        ]);

        // Si registra empleado → enviar notificación al admin
        if ($rol === 'empleado') {

            $adminEmail = config('app.admin_email', 'admin@tudominio.com');

            Mail::to($adminEmail)->send(new NuevoEmpleadoPendiente(
                $user,
                $request->puesto ?? null
            ));

            return redirect()->route('login')->with(
                'success',
                'Te has registrado como empleado. Tu cuenta está pendiente de aprobación.'
            );
        }

        // Cliente queda activo de inmediato
        return redirect()->route('login')->with(
            'success',
            'Registro exitoso. Ya puedes iniciar sesión.'
        );
    }
}
