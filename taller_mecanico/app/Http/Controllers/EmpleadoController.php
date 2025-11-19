<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Mostrar lista de empleados con búsqueda, filtros y paginación
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');
        $rol = $request->input('rol');
        $activo = $request->input('activo');

        $empleados = Empleado::query()

            ->when($busqueda, function ($q) use ($busqueda) {
                $q->where('nombre', 'LIKE', "%$busqueda%")
                  ->orWhere('apellido', 'LIKE', "%$busqueda%")
                  ->orWhere('dni', 'LIKE', "%$busqueda%")
                  ->orWhere('rol', 'LIKE', "%$busqueda%")
                  ->orWhere('correo', 'LIKE', "%$busqueda%");
            })

            ->when($rol, function ($q) use ($rol) {
                $q->where('rol', $rol);
            })

            ->when($activo !== null && $activo !== '', function ($q) use ($activo) {
                $q->where('activo', $activo);
            })

            ->paginate(10)
            ->appends($request->query());

        return view('empleados.index', compact('empleados', 'busqueda', 'rol', 'activo'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('empleados.create');
    }

    // Guardar nuevo empleado
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'required|string',
            'correo' => 'nullable|email',
        ]);

        Empleado::create($request->all());
        return redirect()->route('empleados.index')->with('success', 'Empleado agregado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    // Actualizar empleado
    public function update(Request $request, Empleado $empleado)
    {
        $empleado->update($request->all());
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado.');
    }

    // Eliminar empleado
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado.');
    }
}
