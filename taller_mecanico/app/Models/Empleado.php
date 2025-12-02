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

    public function getRouteKeyName()
    {
        return 'empleado_id';
    }

    public function taller()
    {
        return $this->belongsTo(Taller::class, 'taller_id', 'taller_id');
    }

    // 🔥 Relación agregada (LO NECESITAS para inactivar usuario al inactivar empleado)
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'empleado_id', 'empleado_id');
    }
}
