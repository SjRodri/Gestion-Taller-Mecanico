<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Taller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\EnviarCredenciales;
use Illuminate\Support\Facades\Mail;


class EmpleadoController extends Controller
{
    // -----------------------------------------
    // LISTAR EMPLEADOS + FILTROS
    // -----------------------------------------
    public function index(Request $request)
    {
        $query = Empleado::with('taller');

        if ($request->buscar) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . request('buscar') . '%')
                    ->orWhere('apellido', 'LIKE', '%' . request('buscar') . '%')
                    ->orWhere('dni', 'LIKE', '%' . request('buscar') . '%');
            });
        }

        if ($request->rol) {
            $query->where('rol', $request->rol);
        }

        if ($request->activo !== null && $request->activo !== "") {
            $query->where('activo', $request->activo);
        }

        if ($request->taller) {
            $query->where('taller_id', $request->taller);
        }

        $empleados = $query->orderBy('empleado_id', 'DESC')->paginate(10);
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
    // GUARDAR EMPLEADO + CREAR USUARIO
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
            'activo'        => 'required|in:1',
        ], [
            'dni.required'           => 'El campo DNI es obligatorio.',
            'dni.numeric'            => 'El campo DNI debe contener solo números.',
            'dni.digits_between'     => 'El campo DNI debe tener entre 1 y 13 dígitos.',
            'dni.unique'             => 'El DNI ingresado ya está registrado.',

            'nombre.required'        => 'El nombre es obligatorio.',
            'nombre.max'             => 'El nombre no puede exceder los 100 caracteres.',

            'apellido.required'      => 'El apellido es obligatorio.',
            'apellido.max'           => 'El apellido no puede exceder los 100 caracteres.',

            'telefono.numeric'       => 'El teléfono debe contener solo números.',
            'telefono.digits_between' => 'El teléfono debe tener máximo 8 dígitos.',
            'telefono.unique'        => 'Este número de teléfono ya está registrado.',

            'rol.required'           => 'El rol es obligatorio.',

            'taller_id.required'     => 'Debe seleccionar un taller.',
            'taller_id.exists'       => 'El taller seleccionado no existe.',

            'correo.required'        => 'El correo es obligatorio.',
            'correo.email'           => 'Ingrese un correo electrónico válido.',
            'correo.unique'          => 'El correo ingresado ya está registrado.',

            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date'     => 'Debe ingresar una fecha válida.',

            'activo.required'        => 'El estado activo es obligatorio.',
        ]);

        // 1. Crear empleado
        $empleado = Empleado::create($request->all());

        // 2. Generar contraseña aleatoria
        $password = Str::random(10);

        // 3. Crear usuario automáticamente
        Usuario::create([
            'email'         => $empleado->correo,
            'password_hash' => Hash::make($password),
            'rol'           => strtolower($empleado->rol) === 'administrador' || strtolower($empleado->rol) === 'admin' ? 'admin' : 'empleado',
            'empleado_id'   => $empleado->empleado_id,
            'activo'        => 1,
        ]);

        // Enviar correo con credenciales
        Mail::to($empleado->correo)->send(
            new EnviarCredenciales(
                $empleado->nombre . ' ' . $empleado->apellido,
                $empleado->correo,
                $password
            )
        );


        return redirect()->route('empleados.index')
            ->with('success', 'Empleado y usuario creado correctamente.');
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
    // ACTUALIZAR EMPLEADO + ACTUALIZAR USUARIO
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
        ], [
            'dni.required'           => 'El campo DNI es obligatorio.',
            'dni.numeric'            => 'El campo DNI debe contener solo números.',
            'dni.digits_between'     => 'El campo DNI debe tener entre 1 y 13 dígitos.',
            'dni.unique'             => 'El DNI ingresado ya está registrado por otro empleado.',

            'nombre.required'        => 'El nombre es obligatorio.',
            'nombre.max'             => 'El nombre no puede exceder los 100 caracteres.',

            'apellido.required'      => 'El apellido es obligatorio.',
            'apellido.max'           => 'El apellido no puede exceder los 100 caracteres.',

            'telefono.numeric'       => 'El teléfono debe contener solo números.',
            'telefono.digits_between' => 'El teléfono debe tener máximo 8 dígitos.',
            'telefono.unique'        => 'Este número de teléfono ya está registrado.',

            'rol.required'           => 'El rol es obligatorio.',

            'taller_id.required'     => 'Debe seleccionar un taller.',
            'taller_id.exists'       => 'El taller seleccionado no existe.',

            'correo.required'        => 'El correo es obligatorio.',
            'correo.email'           => 'Ingrese un correo electrónico válido.',
            'correo.unique'          => 'El correo ingresado ya está registrado por otro empleado.',

            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date'     => 'Debe ingresar una fecha válida.',

            'activo.required'        => 'Debe seleccionar el estado del empleado.',
            'activo.boolean'         => 'El campo activo debe ser verdadero o falso.',
        ]);

        // 1. Actualizar empleado
        $empleado->update($request->all());

        // 2. Actualizar usuario si existe
        if ($empleado->usuario) {
            $empleado->usuario->update([
                'email'  => $empleado->correo,
                'rol'    => strtolower($empleado->rol) === 'administrador' || strtolower($empleado->rol) === 'admin'
                    ? 'admin'
                    : 'empleado',
                'activo' => $empleado->activo,
            ]);
        }


        return redirect()->route('empleados.index')
            ->with('success', 'Empleado y usuario actualizados correctamente.');
    }

    // -----------------------------------------
    // ELIMINAR (INACTIVAR) EMPLEADO + USUARIO
    // -----------------------------------------
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        $empleado->activo = 0;
        $empleado->save();

        if ($empleado->usuario) {
            $empleado->usuario->update(['activo' => 0]);
        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado y usuario inactivados correctamente.');
    }
}
