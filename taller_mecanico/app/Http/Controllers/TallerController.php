<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Illuminate\Http\Request;

class TallerController extends Controller
{
    public function index(Request $request)
    {
        $buscar        = $request->input('buscar');          // Buscador general
        $nombreSelect  = $request->input('nombre_select');   // Filtro por nombre exacto
        $ubicacion     = $request->input('ubicacion');       // Filtro por ubicación

        // 🔹 Obtener lista de nombres únicos para el select
        $nombresTalleres = Taller::select('nombre')
            ->distinct()
            ->orderBy('nombre')
            ->get();

        // 🔹 Obtener lista de ubicaciones únicas para el select
        $ubicacionesTalleres = Taller::select('ubicacion')
            ->distinct()
            ->orderBy('ubicacion')
            ->get();

        // QUERY PRINCIPAL
        $talleres = Taller::query()

            // 🔍 BUSCADOR GENERAL (busca en varios campos)
            ->when($buscar, function ($q) use ($buscar) {
                $q->where(function ($sub) use ($buscar) {
                    $sub->where('nombre', 'LIKE', "%$buscar%")
                        ->orWhere('ubicacion', 'LIKE', "%$buscar%")
                        ->orWhere('telefono', 'LIKE', "%$buscar%")
                        ->orWhere('email', 'LIKE', "%$buscar%")
                        ->orWhere('horario', 'LIKE', "%$buscar%");
                });
            })

            // 🎯 SELECT DE NOMBRE EXACTO
            ->when($nombreSelect, function ($q) use ($nombreSelect) {
                $q->where('nombre', $nombreSelect);
            })

            // 🎯 SELECT DE UBICACIÓN EXACTA
            ->when($ubicacion, function ($q) use ($ubicacion) {
                $q->where('ubicacion', $ubicacion);
            })

            ->orderBy('taller_id', 'DESC')
            ->paginate(10)
            ->appends($request->query());

        return view(
            'talleres.index',
            compact(
                'talleres',
                'buscar',
                'ubicacion',
                'nombreSelect',
                'nombresTalleres',
                'ubicacionesTalleres'
            )
        );
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
            'ubicacion' => 'required',
            'telefono'  => 'required',
            'email'     => 'required|email',
            'horario'   => 'required',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
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
            'ubicacion' => 'required',
            'telefono'  => 'required',
            'email'     => 'required|email',
            'horario'   => 'required',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
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
