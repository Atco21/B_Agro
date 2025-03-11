<!DOCTYPE html>
<html>
<head>
    <title>Informe de Órdenes</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Informe de Órdenes</h1>
<p>Rango de fechas: {{ $fechaInicio }} a {{ $fechaFin }}</p>

<table>
    <thead>
        <tr>
            <th>ID Orden</th>
            <th>Estado</th>
            <th>Tarea</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Tratamiento</th>
            <th>Parcela</th>
        </tr>
    </thead>
    <tbody>
        @forelse($ordenes as $orden)
            <tr>
                <td>{{ $orden->id }}</td>
                <td>{{ $orden->estado }}</td>
                <td>{{ $orden->tarea }}</td>
                <td>{{ $orden->fecha_inicio }}</td>
                <td>{{ $orden->fecha_fin }}</td>
                <td>{{ $orden->tratamiento->nombre ?? 'No asignado' }}</td>
                <td>{{ $orden->parcela->nombre ?? 'No asignada' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No se encontraron órdenes en este rango de fechas.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
