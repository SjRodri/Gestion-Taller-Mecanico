<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taller;

class MapController extends Controller
{
    public function index()
    {
        return view('mapa.index');
    }

    public function talleresJson()
    {
        return Taller::all();
    }
}
