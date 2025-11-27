<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\Request;

class TallerController extends Controller
{

    // LISTA CON FILTROS
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $talleres = Taller::when($buscar, function ($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%$buscar%")
                  ->orWhere('ubicacion', 'LIKE', "%$buscar%")
                  ->orWhere('telefono', 'LIKE', "%$buscar%")
                  ->orWhere('email', 'LIKE', "%$buscar%");
            })
            ->orderBy('taller_id', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        return view('talleres.index', compact('talleres', 'buscar'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        return view('talleres.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required',
            'ubicacion' => 'nullable',
            'telefono'  => 'nullable',
            'email'     => 'nullable|email',
            'horario'   => 'nullable',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Taller::create($request->all());

        return redirect()->route('talleres.index')
            ->with('success', 'Taller creado correctamente');
    }

    // FORMULARIO EDITAR
    public function edit($id)
    {
        $taller = Taller::findOrFail($id);
        return view('talleres.edit', compact('taller'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'    => 'required',
            'ubicacion' => 'nullable',
            'telefono'  => 'nullable',
            'email'     => 'nullable|email',
            'horario'   => 'nullable',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $taller = Taller::findOrFail($id);
        $taller->update($request->all());

        return redirect()->route('talleres.index')
            ->with('success', 'Taller actualizado correctamente');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Taller::destroy($id);

        return redirect()->route('talleres.index')
            ->with('success', 'Taller eliminado correctamente');
    }
}
