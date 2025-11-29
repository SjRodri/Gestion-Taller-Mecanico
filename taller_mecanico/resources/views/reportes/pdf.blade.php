<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas - PDF</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
        }

        .total {
            font-weight: bold;
            color: #000;
        }

        .header-info {
            margin-bottom: 15px;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <h2>Listado de Reportes de Ventas</h2>

    <div class="header-info">
        <strong>Fecha de generación:</strong> {{ date('d/m/Y H:i') }} <br>
        <strong>Total de registros:</strong> {{ count($reportes) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Total</th>
                <th>Clientes Nuevos</th>
                <th>Repuestos Ordenados</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reportes as $r)
                <tr>
                    <td>{{ date('d/m/Y', strtotime($r->fecha)) }}</td>
                    <td>{{ $r->descripcion_reporte }}</td>
                    <td>${{ number_format($r->total, 2) }}</td>
                    <td>{{ $r->clientes_nuevos }}</td>
                    <td>{{ $r->repuestos_ordenados }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
