<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Taller;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // LISTA
    public function index()
    {
        $empleados = Empleado::with('taller')->paginate(10);
        return view('empleados.index', compact('empleados'));
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
