<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Taller;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // Mostrar lista de empleados con búsqueda, filtros y paginación
    // LISTA CON FILTROS

    public function index(Request $request)
    {
        // Capturamos los parámetros de búsqueda
        $busqueda = $request->input('buscar');
        $rol = $request->input('rol');
        $activo = $request->input('activo');
        $taller_id = $request->input('taller'); // filtro independiente por taller

        // Consulta con filtros
        $empleados = Empleado::with('taller')
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
            ->when($taller_id, function ($q) use ($taller_id) {
                $q->where('taller_id', $taller_id); // filtro independiente por taller
            })
            ->paginate(10)
            ->appends($request->query());

        // Obtenemos todos los talleres para el dropdown
        $talleres = Taller::all();

        return view('empleados.index', compact('empleados', 'busqueda', 'rol', 'activo', 'taller_id', 'talleres'));
    }


    // FORMULARIO CREAR
    public function create()
    {
        $talleres = Taller::all();
        return view('empleados.create', compact('talleres'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'rol' => 'required',
            'taller_id' => 'required|exists:talleres,taller_id',
            'correo' => 'required|email',
            'fecha_ingreso' => 'required|date',
            'activo' => 'required|boolean',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $talleres = Taller::all();

        return view('empleados.edit', compact('empleado', 'talleres'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'rol' => 'required',
            'taller_id' => 'required|exists:talleres,taller_id',
            'correo' => 'required|email',
            'fecha_ingreso' => 'required|date',
            'activo' => 'required|boolean',
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente');
    }

    // Marcar empleado como inactivo en lugar de eliminarlo
    public function destroy(Empleado $empleado)
    {
        $empleado->activo = 0; // marcar como inactivo
        $empleado->save();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado marcado como inactivo.');
    }
}
