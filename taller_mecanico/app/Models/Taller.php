<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = 'talleres';
    protected $primaryKey = 'taller_id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'ubicacion',
        'telefono',
        'email',
        'horario',
        'latitud',
        'longitud'
    ];
}
