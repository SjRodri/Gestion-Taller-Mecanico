<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'vehiculo_id';
    public $timestamps = false;

    protected $fillable = [
        'matricula',
        'modelo',
        'ano',
        'color',
        'vin',
        'cliente_id',

    ];
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }
}
