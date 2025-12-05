<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;


use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Puedes usar paginate o get
        $vehiculos = Vehiculo::orderBy('matricula')->paginate(10);



        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehiculos.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'matricula'   => 'required|string|max:50|unique:vehiculos,matricula',
            'modelo'      => 'required|string|max:100',
            'ano'         => 'nullable|integer|min:1900|max:2099',
            'color'       => 'nullable|string|max:50',
            'vin'         => 'nullable|string|max:50',

        ]);

        Vehiculo::create([
            'matricula' => $request->matricula,
            'modelo'    => $request->modelo,
            'ano'       => $request->ano,
            'color'     => $request->color,
            'vin'       => $request->vin,
            'cliente_ic' => $request->cliente_ic ?? 0, // valor por defecto
        ]);


        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo registrado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
