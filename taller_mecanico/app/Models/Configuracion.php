<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'config_id'; // ← usar la llave real
    public $timestamps = false;

    protected $fillable = [
        'clave',
        'valor',
        'descripcion'
    ];
}
