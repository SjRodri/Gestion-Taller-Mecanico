<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    // MOSTRAR LISTA (según rol)
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'admin') {
            $configuraciones = Configuracion::all();
        } elseif ($user->rol === 'cliente') {
            $clienteId = $user->cliente_id;
            $configuraciones = Configuracion::where('cliente_id', $clienteId)->get();
        } elseif ($user->rol === 'empleado') {
            $empleadoId = $user->empleado_id;
            $configuraciones = Configuracion::where('empleado_id', $empleadoId)->get();
        } else {
            // Caso por defecto: no mostrar nada
            $configuraciones = collect();
        }

        return view('configuracion.index', compact('configuraciones'))
            ->with('seccion', 'configuracion');
    }

    // FORMULARIO DE CREACIÓN
    public function create()
    {
        $user = Auth::user();

        // Determinar propietario
        $clienteId = null;
        $empleadoId = null;

        if ($user->rol === 'cliente') {
            $clienteId = $user->cliente_id;
        } elseif ($user->rol === 'empleado') {
            $empleadoId = $user->empleado_id;
        }

        return view('configuracion.create', [
            'clienteId' => $clienteId,
            'empleadoId' => $empleadoId,
            'seccion' => 'configuracion'
        ]);
    }

    // GUARDAR NUEVA CONFIGURACIÓN (vinculada al propietario correspondiente)
    public function store(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'clave' => 'required|max:255',
            'valor' => 'required|max:255',
            'descripcion' => 'nullable|max:500'
        ];

        // Validación única por propietario (cliente o empleado). Admin: global unique.
        if ($user->rol === 'admin') {
            $rules['clave'] .= '|unique:configuracion,clave';
            $extraData = []; // nada que asignar
        } elseif ($user->rol === 'cliente') {
            $clienteId = $user->cliente_id;
            $rules['clave'] .= '|unique:configuracion,clave,NULL,id,cliente_id,' . $clienteId;
            $extraData = ['cliente_id' => $clienteId, 'empleado_id' => null];
        } elseif ($user->rol === 'empleado') {
            $empleadoId = $user->empleado_id;
            $rules['clave'] .= '|unique:configuracion,clave,NULL,id,empleado_id,' . $empleadoId;
            $extraData = ['empleado_id' => $empleadoId, 'cliente_id' => null];
        } else {
            // Por seguridad, rechazamos otros roles
            return redirect()->route('configuracion.index')
                ->with('error', 'No tienes permiso para crear configuraciones.');
        }

        $request->validate($rules);

        Configuracion::create(array_merge([
            'clave' => $request->clave,
            'valor' => $request->valor,
            'descripcion' => $request->descripcion,
        ], $extraData));

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración creada correctamente.');
    }

    // FORMULARIO DE EDICIÓN (con protección por propietario)
    public function edit($id)
    {
        $config = Configuracion::findOrFail($id);
        $user = Auth::user();

        if ($user->rol !== 'admin') {
            if ($user->rol === 'cliente' && $config->cliente_id !== $user->cliente_id) {
                return redirect()->route('configuracion.index')
                    ->with('error', 'No tienes permiso para editar esta configuración.');
            }

            if ($user->rol === 'empleado' && $config->empleado_id !== $user->empleado_id) {
                return redirect()->route('configuracion.index')
                    ->with('error', 'No tienes permiso para editar esta configuración.');
            }
        }

        return view('configuracion.edit', compact('config'))
            ->with('seccion', 'configuracion');
    }

    // GUARDAR CAMBIOS (con protección y validación unique por propietario)
    public function update(Request $request, $id)
    {
        $config = Configuracion::findOrFail($id);
        $user = Auth::user();

        if ($user->rol !== 'admin') {
            if ($user->rol === 'cliente' && $config->cliente_id !== $user->cliente_id) {
                return redirect()->route('configuracion.index')
                    ->with('error', 'No tienes permiso para modificar esta configuración.');
            }

            if ($user->rol === 'empleado' && $config->empleado_id !== $user->empleado_id) {
                return redirect()->route('configuracion.index')
                    ->with('error', 'No tienes permiso para modificar esta configuración.');
            }
        }

        $rules = [
            'valor' => 'required|max:255',
            'descripcion' => 'nullable|max:500'
        ];

        // Validar 'clave' única únicamente si permite cambiarla; si no la cambia, no la incluimos.
        if ($request->filled('clave')) {
            if ($user->rol === 'admin') {
                $rules['clave'] = 'required|max:255|unique:configuracion,clave,' . $config->id;
            } elseif ($user->rol === 'cliente') {
                $clienteId = $user->cliente_id;
                $rules['clave'] = 'required|max:255|unique:configuracion,clave,' . $config->id . ',id,cliente_id,' . $clienteId;
            } elseif ($user->rol === 'empleado') {
                $empleadoId = $user->empleado_id;
                $rules['clave'] = 'required|max:255|unique:configuracion,clave,' . $config->id . ',id,empleado_id,' . $empleadoId;
            }
        }

        $request->validate($rules);

        // No cambiar los ownership fields (cliente_id/empleado_id) aquí, solo actualizamos valor/descripcion y opcionalmente clave
        if ($request->filled('clave')) {
            $config->clave = $request->clave;
        }

        $config->valor = $request->valor;
        $config->descripcion = $request->descripcion ?? $config->descripcion;
        $config->save();

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración actualizada correctamente.');
    }

    // ELIMINAR CONFIGURACIÓN (con protección)
    public function destroy($id)
    {
        $config = Configuracion::findOrFail($id);
        $user = Auth::user();

        if ($user->rol !== 'admin') {
            if ($user->rol === 'cliente' && $config->cliente_id !== $user->cliente_id) {
                return redirect()->route('configuracion.index')
                    ->with('error', 'No tienes permiso para eliminar esta configuración.');
            }

            if ($user->rol === 'empleado' && $config->empleado_id !== $user->empleado_id) {
                return redirect()->route('configuracion.index')
                    ->with('error', 'No tienes permiso para eliminar esta configuración.');
            }
        }

        $config->delete();

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración eliminada correctamente.');
    }
}
