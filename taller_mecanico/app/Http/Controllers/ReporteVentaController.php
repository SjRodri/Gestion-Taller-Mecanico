<?php

namespace App\Http\Controllers;

use App\Models\ReporteVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Exports\ReportesExport;   
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteVentaController extends Controller
{
    public function index()
    {
        $reportes = ReporteVenta::orderBy('fecha', 'desc')->paginate(10);

        $mesActual = date('m');
        $anioActual = date('Y');

        $summary = [
            'ganancias' => ReporteVenta::whereYear('fecha', $anioActual)->whereMonth('fecha', $mesActual)->sum('total'),
            'clientes_nuevos' => ReporteVenta::whereYear('fecha', $anioActual)->whereMonth('fecha', $mesActual)->sum('clientes_nuevos'),
            'repuestos' => ReporteVenta::whereYear('fecha', $anioActual)->whereMonth('fecha', $mesActual)->sum('repuestos_ordenados'),
        ];

        $ultimos7 = ReporteVenta::orderBy('fecha', 'asc')->take(7)->get();

        $lineLabels = $ultimos7->pluck('fecha')->map(fn($d) => date('d-m', strtotime($d)))->toArray();
        $lineData   = $ultimos7->pluck('total')->map(fn($v) => (float)$v)->toArray();

        $porMes = ReporteVenta::select(DB::raw('MONTH(fecha) as mes'), DB::raw('SUM(total) as total'))
            ->whereYear('fecha', $anioActual)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->pluck('total', 'mes')
            ->toArray();

        $barLabels = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        $barData = [];
        for ($m = 1; $m <= 12; $m++) {
            $barData[] = $porMes[$m] ?? 0;
        }

        $clientesList = [];

        return view('reportes.index', compact(
            'reportes', 'summary', 'lineLabels', 'lineData', 'barLabels', 'barData', 'clientesList'
        ));
    }

    public function create()
    {
        return view('reportes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'descripcion_reporte' => 'required|string|max:255',
            'total' => 'required|numeric',
            'clientes_nuevos' => 'required|integer',
            'repuestos_ordenados' => 'required|integer',
            'taller_id' => 'nullable|integer'
        ]);

        ReporteVenta::create($validated);

        return redirect()->route('reportes.index')->with('success', 'Reporte creado con éxito.');
    }

    public function edit($id)
    {
        $reporte = ReporteVenta::findOrFail($id);
        return view('reportes.edit', compact('reporte'));
    }

    public function update(Request $request, $id)
    {
        $reporte = ReporteVenta::findOrFail($id);

        $validated = $request->validate([
            'fecha' => 'required|date',
            'descripcion_reporte' => 'required|string|max:255',
            'total' => 'required|numeric',
            'clientes_nuevos' => 'required|integer',
            'repuestos_ordenados' => 'required|integer',
            'taller_id' => 'nullable|integer'
        ]);

        $reporte->update($validated);

        return redirect()->route('reportes.index')->with('success', 'Reporte actualizado correctamente.');
    }

    public function destroy($id)
    {
        $reporte = ReporteVenta::findOrFail($id);
        $reporte->delete();

        return redirect()->route('reportes.index')->with('success', 'Reporte eliminado.');
    }
   
 // EXPORTAR PDF
    public function exportPDF()
    {
        $reportes = ReporteVenta::all();

        $pdf = Pdf::loadView('reportes.pdf', compact('reportes'))
                  ->setPaper('letter', 'portrait');

        return $pdf->download('reportes.pdf');
    }
}
