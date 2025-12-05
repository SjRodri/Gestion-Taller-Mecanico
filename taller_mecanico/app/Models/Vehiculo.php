<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'vehiculo_id';
    public $timestamps = false; // tu tabla no tiene created_at ni updated_at

    protected $fillable = [
        'matricula',
        'modelo',
        'ano',
        'color',
        'vin',

    ];
}
