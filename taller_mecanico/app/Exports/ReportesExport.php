<?php

namespace App\Exports;

use App\Models\ReporteVenta;

class ReportesExport implements FromCollection
{
    public function collection()
    {
        return ReporteVenta::all();
    }
}
