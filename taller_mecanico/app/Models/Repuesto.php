<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $table = 'repuestos';
    protected $primaryKey = 'repuesto_id';
    public $timestamps = false; // no tiene created_at ni updated_at

    protected $fillable = [
        'descripcion_repuesto',
        'categoria',
        'precio',
        'cantidad',
        'reorder_threshold'
    ];
}
