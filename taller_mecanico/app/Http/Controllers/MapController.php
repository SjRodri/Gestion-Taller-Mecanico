<?php

namespace App\Http\Controllers;

use App\Models\Taller;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showMap()
    {
        // Tomamos los talleres y convertimos ubicación en lat y lng
        $locations = Taller::all()->map(function ($taller) {
            if ($taller->ubicacion) {
                // Suponiendo que la ubicación es "lat,lng"
                $coords = explode(',', $taller->ubicacion);
                return [
                    'latitude' => floatval($coords[0]),
                    'longitude' => floatval($coords[1]),
                    'name' => $taller->nombre ?? 'Taller sin nombre'
                ];
            }
            return null;
        })->filter(); // elimina nulls si hay ubicaciones vacías

        return view('map', compact('locations'));
    }
}
