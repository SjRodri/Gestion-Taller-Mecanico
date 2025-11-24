<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';
    protected $primaryKey = 'orden_id';
    public $timestamps = false;

    protected $fillable = [
        'descripcion_orden',
        'taller_id',
        'cliente_id',
        'vehiculo_id',
        'fecha',
        'estado'
    ];

    public function taller()
    {
        return $this->belongsTo(Taller::class, 'taller_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}
