<!DOCTYPE html>
<html>

<head>
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

        /* Contenedor que agrupa empresa y cliente lado a lado */
        .datos-encabezado {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .datos-encabezado td {
            vertical-align: top;
            width: 50%;
            padding: 0 10px;
        }

        /* Estilos para bloques internos (empresa y cliente) */
        .datos-empresa,
        .datos-cliente {
            width: 100%;
            border: 1px solid #444;
            border-collapse: collapse;
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

        /* Mantengo el estilo de datos-factura para las demás secciones */
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
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .tabla-lineas th,
        .tabla-lineas td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }

        .tabla-lineas th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .totales {
            width: 100%;
            margin-top: 10px;
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

    {{-- Encabezado --}}
    <div class="encabezado">
        <h1>Factura N.º {{ $factura->numero }}</h1>
    </div>

    {{--
      Tabla que agrupa, en dos columnas, la información de la empresa (izquierda)
      y la información del cliente (derecha), justo debajo del número de factura
    --}}
    <table class="datos-encabezado">
        <tr>
            <!-- Columna izquierda: datos de la empresa -->
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

            <!-- Columna derecha: datos del cliente -->
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

    {{-- Datos de la factura (fecha, tipo de pago, estado) --}}
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

    {{-- Tabla de líneas de la factura --}}
    <table class="tabla-lineas">
        <thead>
            <tr>
                <th style="width: 30%;">Explotación</th>
                <th style="width: 30%;">Cultivo</th>
                <th style="width: 10%;">Cantidad</th>
                <th style="width: 15%;">Precio Unit.</th>
                <th style="width: 15%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->lineas as $linea)
                <tr>
                    <td>{{ $linea->explotacion->nombre }}</td>
                    <td>{{ $linea->cultivo->nombre }}</td>
                    <td class="text-right">{{ number_format($linea->cantidad, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($linea->precio_unitario, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($linea->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totales finales --}}
    <table class="totales">
        <tr>
            <td class="label">Total Neto:</td>
            <td class="valor">{{ number_format($factura->neto, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Impuestos (21%):</td>
            <td class="valor">{{ number_format($factura->impuestos, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label"><strong>Total Factura:</strong></td>
            <td class="valor"><strong>{{ number_format($factura->total, 2, ',', '.') }}</strong></td>
        </tr>
    </table>

</body>

</html>
