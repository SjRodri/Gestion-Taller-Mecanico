<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'empleado_id';
    public $timestamps = false;

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'telefono',
        'rol',
        'taller_id',
        'correo',
        'fecha_ingreso',
        'activo'
    ];
}
