<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Taller;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    // -----------------------------------------
    // LISTAR EMPLEADOS + FILTROS
    // -----------------------------------------
    public function index(Request $request)
    {
        $query = Empleado::with('taller');

        // FILTRO: BUSCAR
        if ($request->buscar) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                    ->orWhere('apellido', 'LIKE', '%' . $request->buscar . '%')
                    ->orWhere('dni', 'LIKE', '%' . $request->buscar . '%');
            });
        }

        // FILTRO: ROL
        if ($request->rol) {
            $query->where('rol', $request->rol);
        }

        // FILTRO: ACTIVO
        if ($request->activo !== null && $request->activo !== "") {
            $query->where('activo', $request->activo);
        }

        // FILTRO: TALLER
        if ($request->taller) {
            $query->where('taller_id', $request->taller);
        }

        // ORDEN Y PAGINACIÓN
        $empleados = $query->orderBy('empleado_id', 'DESC')->paginate(10);

        // CARGA DE TALLERES PARA EL SELECT DEL INDEX
        $talleres = Taller::all();

        return view('empleados.index', compact('empleados', 'talleres'));
    }

    // -----------------------------------------
    // FORMULARIO CREAR
    // -----------------------------------------
    public function create()
    {
        $talleres = Taller::all();
        return view('empleados.create', compact('talleres'));
    }

    // -----------------------------------------
    // GUARDAR EMPLEADO
    // -----------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'dni'           => 'required|numeric|digits_between:1,13|unique:empleados,dni',
            'nombre'        => 'required|string|max:100',
            'apellido'      => 'required|string|max:100',
            'telefono'      => 'nullable|numeric|digits_between:1,8|unique:empleados,telefono',
            'rol'           => 'required|string|max:100',
            'taller_id'     => 'required|exists:talleres,taller_id',
            'correo'        => 'required|email|unique:empleados,correo',
            'fecha_ingreso' => 'required|date',
            'activo'        => 'required|boolean',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    // -----------------------------------------
    // FORMULARIO EDITAR
    // -----------------------------------------
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $talleres = Taller::all();

        return view('empleados.edit', compact('empleado', 'talleres'));
    }

    // -----------------------------------------
    // ACTUALIZAR
    // -----------------------------------------
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $request->validate([
            'dni'           => 'required|numeric|digits_between:1,13|unique:empleados,dni,' . $empleado->empleado_id . ',empleado_id',
            'nombre'        => 'required|string|max:100',
            'apellido'      => 'required|string|max:100',
            'telefono'      => 'nullable|numeric|digits_between:1,8|unique:empleados,telefono,' . $empleado->empleado_id . ',empleado_id',
            'rol'           => 'required|string|max:100',
            'taller_id'     => 'required|exists:talleres,taller_id',
            'correo'        => 'required|email|unique:empleados,correo,' . $empleado->empleado_id . ',empleado_id',
            'fecha_ingreso' => 'required|date',
            'activo'        => 'required|boolean',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    // -----------------------------------------
    // ELIMINAR
    // -----------------------------------------
    // ELIMINAR (INACTIVAR)
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        $empleado->activo = 0;
        $empleado->save();

        if ($empleado->usuario) {
            $empleado->usuario->update(['activo' => 0]);
        }

        return redirect()->route('empleados.index')->with('success', 'Empleado inactivado correctamente');
    }
}
