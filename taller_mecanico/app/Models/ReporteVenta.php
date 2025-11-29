<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteVenta extends Model
{
    protected $table = 'reportes_ventas';

    protected $primaryKey = 'reporte_id';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'descripcion_reporte',
        'total',
        'clientes_nuevos',
        'repuestos_ordenados',
        'taller_id'
    ];
}
