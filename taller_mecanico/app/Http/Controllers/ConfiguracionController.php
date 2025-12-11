<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionController extends Controller
{
    /**
     * LISTADO SEGÚN ROL
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->rol === 'cliente') {
            $configuraciones = Configuracion::where('cliente_id', $user->cliente_id)->get();
        } elseif ($user->rol === 'empleado') {
            $configuraciones = Configuracion::where('empleado_id', $user->empleado_id)->get();
        } else {
            // Admin no debe entrar
            return abort(403, 'No autorizado.');
        }

        return view('configuracion.index', compact('configuraciones'))
            ->with('seccion', 'configuracion');
    }


    /**
     * FORMULARIO DE CREACIÓN
     */
    public function create()
    {
        $user = Auth::user();

        if (!in_array($user->rol, ['cliente', 'empleado'])) {
            return abort(403, 'No autorizado.');
        }

        return view('configuracion.create', [
            'clienteId' => $user->rol === 'cliente' ? $user->cliente_id : null,
            'empleadoId' => $user->rol === 'empleado' ? $user->empleado_id : null,
            'seccion' => 'configuracion'
        ]);
    }


    /**
     * GUARDAR CONFIGURACIÓN
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!in_array($user->rol, ['cliente', 'empleado'])) {
            return abort(403, 'No autorizado.');
        }

        $rules = [
            'clave' => 'required|max:255',
            'valor' => 'required|max:255',
            'descripcion' => 'nullable|max:500',
        ];

        // Validación única por tipo de propietario
        if ($user->rol === 'cliente') {
            $rules['clave'] .= '|unique:configuracion,clave,NULL,id,cliente_id,' . $user->cliente_id;
            $extraData = ['cliente_id' => $user->cliente_id, 'empleado_id' => null];
        } else {
            $rules['clave'] .= '|unique:configuracion,clave,NULL,id,empleado_id,' . $user->empleado_id;
            $extraData = ['empleado_id' => $user->empleado_id, 'cliente_id' => null];
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


    /**
     * FORMULARIO DE EDICIÓN
     */
    public function edit($id)
    {
        $user = Auth::user();
        $config = Configuracion::findOrFail($id);

        if ($user->rol === 'cliente' && $config->cliente_id !== $user->cliente_id) {
            return abort(403, 'No autorizado.');
        }

        if ($user->rol === 'empleado' && $config->empleado_id !== $user->empleado_id) {
            return abort(403, 'No autorizado.');
        }

        return view('configuracion.edit', compact('config'))
            ->with('seccion', 'configuracion');
    }


    /**
     * ACTUALIZAR CONFIGURACIÓN
     */
    public function update(Request $request, $id)
    {
        $config = Configuracion::findOrFail($id);
        $user = Auth::user();

        // Protección de acceso
        if ($user->rol === 'cliente' && $config->cliente_id !== $user->cliente_id) {
            return abort(403, 'No autorizado.');
        }

        if ($user->rol === 'empleado' && $config->empleado_id !== $user->empleado_id) {
            return abort(403, 'No autorizado.');
        }

        $rules = [
            'valor' => 'required|max:255',
            'descripcion' => 'nullable|max:500'
        ];

        // Validar clave solo si la cambian
        if ($request->filled('clave')) {
            if ($user->rol === 'cliente') {
                $rules['clave'] =
                    'required|max:255|unique:configuracion,clave,' .
                    $config->id . ',id,cliente_id,' . $user->cliente_id;
            } elseif ($user->rol === 'empleado') {
                $rules['clave'] =
                    'required|max:255|unique:configuracion,clave,' .
                    $config->id . ',id,empleado_id,' . $user->empleado_id;
            }
        }

        $request->validate($rules);

        if ($request->filled('clave')) {
            $config->clave = $request->clave;
        }

        $config->valor = $request->valor;
        $config->descripcion = $request->descripcion;
        $config->save();

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración actualizada correctamente.');
    }


    /**
     * ELIMINAR CONFIGURACIÓN
     */
    public function destroy($id)
    {
        $config = Configuracion::findOrFail($id);
        $user = Auth::user();

        if ($user->rol === 'cliente' && $config->cliente_id !== $user->cliente_id) {
            return abort(403, 'No autorizado.');
        }

        if ($user->rol === 'empleado' && $config->empleado_id !== $user->empleado_id) {
            return abort(403, 'No autorizado.');
        }

        $config->delete();

        return redirect()->route('configuracion.index')
            ->with('success', 'Configuración eliminada correctamente.');
    }
}
