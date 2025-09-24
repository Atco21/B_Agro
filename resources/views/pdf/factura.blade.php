<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta charset="utf-8">
    <title>Factura {{ $factura->numero }}</title>
    <style>
        /* Estilos básicos para DomPDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .encabezado {
            text-align: center;
            margin-bottom: 20px;
        }

        .encabezado h1 {
            margin: 0;
            font-size: 24px;
        }

        .datos-encabezado {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .datos-encabezado td {
            vertical-align: top;
            width: 25%;
            padding: 0 10px;
        }

        .datos-empresa,
        .datos-cliente {
            width: 100%;
            height: 200px;
            border: 2px solid #444;
        }

        .datos-empresa td,
        .datos-cliente td {
            padding: 4px 8px;
        }

        .datos-empresa td.etiqueta,
        .datos-cliente td.etiqueta {
            font-weight: bold;
            width: 30%;
        }

        .datos-factura {
            width: 100%;
            margin-bottom: 20px;
        }

        .datos-factura td {
            padding: 4px 8px;
        }

        .datos-factura td.etiqueta {
            font-weight: bold;
            width: 30%;
        }

        .tabla-lineas {
            width: 100%;
            margin-bottom: 20px;
        }

        .tabla-lineas th,
        .tabla-lineas td {
            padding: 6px;
            text-align: left;
        }

        .tabla-lineas th {
            background-color: #028b69;
            color: white;
        }

        .text-center {
            text-align: center !important;
        }

        .totales {
            width: 100%;
            margin-top: 25px;
        }

        .totales td {
            padding: 4px 8px;
        }

        .totales .label {
            font-weight: bold;
            width: 80%;
        }

        .totales .valor {
            text-align: right;

            width: 20%;
        }

    </style>
</head>

<body>

    <div class="encabezado">
        <h1>Factura N.º {{ $factura->numero }}</h1>
    </div>


    <table class="datos-encabezado">
        <tr>
            <td>
                <table class="datos-empresa">
                    <tr>
                        <td>
                            <h3>AgroControl S.L</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="etiqueta">Dirección:</td>
                        <td>Av Hermanos Maristas 25, 46013, Valencia, Valencia.</td>
                    </tr>
                    <tr>
                        <td class="etiqueta">NIF:</td>
                        <td>12345678X</td>
                    </tr>
                    <tr>
                        <td class="etiqueta">Teléfono:</td>
                        <td>123456789</td>
                    </tr>
                    <tr>
                        <td class="etiqueta">Email:</td>
                        <td>agrocontrol@gmail.com</td>
                    </tr>
                </table>
            </td>

            <td>
                <table class="datos-cliente">
                    <tr>
                        <td>
                            <h3>{{ $factura->cliente->nombre_completo }}</h3>
                        </td>
                    </tr>
                    @if ($factura->cliente->direccion)
                        <tr>
                            <td class="etiqueta">Dirección:</td>
                            <td>{{ $factura->cliente->direccion }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="etiqueta">DNI/NIF:</td>
                        <td>{{ $factura->cliente->dni_nif }}</td>
                    </tr>
                    @if ($factura->cliente->telefono)
                        <tr>
                            <td class="etiqueta">Teléfono:</td>
                            <td>{{ $factura->cliente->telefono }}</td>
                        </tr>
                    @endif
                    @if ($factura->cliente->email)
                        <tr>
                            <td class="etiqueta">Email:</td>
                            <td>{{ $factura->cliente->email }}</td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

    <table class="datos-factura">
        <tr>
            <td class="etiqueta">Fecha:</td>
            <td>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="etiqueta">Tipo de pago:</td>
            <td>{{ ucfirst($factura->tipo_pago) }}</td>
        </tr>
        <tr>
            <td class="etiqueta">Estado:</td>
            <td>{{ ucfirst($factura->estado) }}</td>
        </tr>
    </table>

    <table class="tabla-lineas">
        <thead>
            <tr>
                <th style="width: 30%;">Explotación</th>
                <th style="width: 30%;">Cultivo</th>
                <th class="text-center" style="width: 10%;">Cantidad</th>
                <th class="text-center" style="width: 15%;">Precio Unit.</th>
                <th class="text-center" style="width: 15%;">Subtotal</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($factura->lineas as $linea)
                <tr>
                    <td>{{ $linea->explotacion->nombre }}</td>
                    <td>{{ $linea->cultivo->nombre }}</td>
                    <td class="text-center">{{ number_format($linea->cantidad, 2, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($linea->precio_unitario, 2, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($linea->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totales" border="0">
        <tr>
            <td class="label">Total Neto:</td>
            <td class="valor">{{ number_format($factura->neto, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">I.V.A: (21%) </td>
            <td class="valor">{{ number_format($factura->impuestos, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label"><strong>
                    <h3>Total Factura:</h3>
                </strong></td>
            <td class="valor"><strong>
                    <h3>{{ number_format($factura->total, 2, ',', '.') }}</h3>
                </strong></td>
        </tr>
    </table>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

</html>
