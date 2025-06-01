@extends('ventas')

@section('content3')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Cargar historial de facturas (usando la ruta web de controlador)
            fetch(
                'http://192.168.31.27:8000/api/facturas') // Asumimos que en FacturaController añadimos un método JSON para index
                .then(res => res.json())
                .then(facturas => {
                    const tbody = document.querySelector('#historialFacturas tbody');
                    tbody.innerHTML = '';
                    facturas.forEach(f => {
                        tbody.innerHTML += `
                        <tr>
                            <td>${f.cliente.nombre_completo}</td>
                            <td>${parseFloat(f.total).toFixed(2)}</td>
                            <td>${new Date(f.fecha).toLocaleDateString()}</td>
                            <td>
                                <a href="/facturas/${f.id}" class="btn btn-sm btn-info">Ver</a>
                                <a href="/facturas/${f.id}/pdf" class="btn btn-sm btn-success">PDF</a>

                            </td>
                        </tr>`;
                    });
                });

            let lineaIndex = 0;
            const container = document.getElementById('lineasFacturaContainer');

            // Función para recalcular neto, impuestos y total
            function calcularTotales() {
                let neto = 0;
                container.querySelectorAll('.factura-linea').forEach(row => {
                    const cantidad = parseFloat(row.querySelector('input[name="cantidad[]"]').value) || 0;
                    const precio = parseFloat(row.querySelector('input[name="precio_unitario[]"]').value) ||
                        0;
                    const subtotal = cantidad * precio;
                    row.querySelector('.subtotal-visible').textContent = subtotal.toFixed(2);
                    row.querySelector('input[name="subtotal[]"]').value = subtotal.toFixed(2);
                    neto += subtotal;
                });
                const impuestos = parseFloat((neto * 0.21).toFixed(2));
                const total = parseFloat((neto + impuestos).toFixed(2));
                document.getElementById('totalNeto').textContent = neto.toFixed(2);
                document.getElementById('totalImpuestos').textContent = impuestos.toFixed(2);
                document.getElementById('totalFactura').textContent = total.toFixed(2);

                // Asignar a inputs ocultos para enviarlos al servidor
                document.getElementById('inputNeto').value = neto.toFixed(2);
                document.getElementById('inputImpuestos').value = impuestos.toFixed(2);
                document.getElementById('inputTotal').value = total.toFixed(2);
            }

            // Agregar nueva línea
            document.getElementById('agregarLinea').addEventListener('click', () => {
                const template = container.querySelector('.factura-linea.template');
                const newLinea = template.cloneNode(true);
                newLinea.classList.remove('template');
                // Limpiar valores y asignar los nombres adecuados
                newLinea.querySelectorAll('select, input').forEach(input => {
                    if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0;
                        // Si es selectCultivo, deshabilitar hasta elegir explotación
                        if (input.classList.contains('selectCultivo')) {
                            input.innerHTML =
                                '<option value="" disabled selected>Selecciona explotación primero</option>';
                            input.disabled = true;
                        }
                    } else {
                        // inputs de cantidad y precio_unitario
                        if (input.name === 'cantidad[]' || input.name === 'precio_unitario[]') {
                            input.value = '';
                        }
                        // input subtotal oculto
                        if (input.name === 'subtotal[]') {
                            input.value = '0.00';
                        }
                    }
                });
                container.appendChild(newLinea);
                lineaIndex++;
            });

            // Quitar línea
            container.addEventListener('click', e => {
                if (e.target.classList.contains('quitarLinea')) {
                    const lineas = container.querySelectorAll('.factura-linea:not(.template)');
                    if (lineas.length > 0) {
                        e.target.closest('.factura-linea').remove();
                        calcularTotales();
                    }
                }
            });

            // Detectar cambio en explotación para cargar cultivos
            container.addEventListener('change', async e => {
                if (!e.target.classList.contains('selectExplotacion')) return;
                const explotacionId = e.target.value;
                const lineaDiv = e.target.closest('.factura-linea');
                const cultivoSelect = lineaDiv.querySelector('.selectCultivo');

                cultivoSelect.innerHTML = '<option>Cargando...</option>';
                cultivoSelect.disabled = true;

                try {
                    const res = await fetch(`/api/almacen/cosecha/${explotacionId}`);
                    const data = await res.json();
                    let options = '<option value="" disabled selected>Elige cultivo</option>';
                    data.forEach(item => {
                        options +=
                            `<option value="${item.cultivo.id}">${item.cultivo.nombre} (Stock: ${item.stock})</option>`;
                    });
                    cultivoSelect.innerHTML = options;
                    cultivoSelect.disabled = false;
                } catch (err) {
                    cultivoSelect.innerHTML = '<option>Error</option>';
                    console.error(err);
                }
            });

            // Recalcular totales cuando cambian cantidad o precio
            container.addEventListener('input', e => {
                if (
                    e.target.name === 'cantidad[]' ||
                    e.target.name === 'precio_unitario[]'
                ) {
                    calcularTotales();
                }
            });

            // Cuando se manda el formulario, calcular totales finales
            document.getElementById('formCrearFactura').addEventListener('submit', e => {
                calcularTotales();
            });
        });
    </script>

    <div class="w-100 p-5">
        <div class="d-flex">
            <div class="flex-row w-100">
                <h1>Facturación</h1>

                <div class="row">
                    <div class="mt-5 ps-0">
                        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalCrearFactura">
                            Crear factura
                        </button>
                    </div>
                    <table class="table w-75" id="historialFacturas">
                        <thead>
                            <tr>
                                <th class="th_verde_primero">Cliente</th>
                                <th class="th_verde">Total</th>
                                <th class="th_verde">Fecha</th>
                                <th class="th_verde">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- Se llenará vía JS --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal “Crear factura” --}}
    <div class="modal fade" id="modalCrearFactura" tabindex="-1" aria-labelledby="modalCrearFacturaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 900px">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearFacturaLabel">Crear nueva factura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearFactura" action="{{ route('facturas.store') }}" method="POST">
                        @csrf

                        {{-- Número --}}
                        <div class="mb-3">
                            <label for="numeroFactura" class="form-label">Número:</label>
                            <input type="text" id="numeroFactura" name="numero" class="form-control" required>
                        </div>

                        {{-- Cliente --}}
                        <div class="mb-3">
                            <label for="selectCliente" class="form-label">Cliente:</label>
                            <select id="selectCliente" class="form-select" name="cliente_id" required>
                                <option value="" disabled selected>Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fecha --}}
                        <div class="mb-3">
                            <label for="fechaFactura" class="form-label">Fecha:</label>
                            <input type="date" id="fechaFactura" class="form-control" name="fecha"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        {{-- Tipo de pago --}}
                        <div class="mb-3">
                            <label for="tipoPago" class="form-label">Tipo de pago:</label>
                            <select id="tipoPago" class="form-select" name="tipo_pago" required>
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>

                        {{-- Estado --}}
                        <div class="mb-3">
                            <label for="estadoFactura" class="form-label">Estado:</label>
                            <select id="estadoFactura" class="form-select" name="estado" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="pagada">Pagada</option>
                                <option value="vencida">Vencida</option>
                            </select>
                        </div>

                        {{-- Contenedor de líneas --}}
                        <div id="lineasFacturaContainer">
                            {{-- Plantilla oculta para clonación --}}
                            <div class="row factura-linea mb-3 template">
                                <div class="col-md-3">
                                    <label class="form-label">Explotación:</label>
                                    <select class="form-select selectExplotacion" name="explotacion_id[]" required>
                                        <option value="" disabled selected>Elige explotación</option>
                                        @foreach ($explotaciones as $explo)
                                            <option value="{{ $explo->id }}">
                                                {{ $explo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Cultivo:</label>
                                    <select class="form-select selectCultivo" name="cultivo_id[]" required disabled>
                                        <option value="" disabled>
                                            Selecciona explotación primero
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control" name="cantidad[]" min="0"
                                        step="0.01" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Precio unidad:</label>
                                    <input type="number" class="form-control" name="precio_unitario[]" min="0"
                                        step="0.01" required>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger quitarLinea">
                                        -
                                    </button>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <span class="subtotal-visible">0.00</span>
                                    <input type="hidden" name="subtotal[]" value="0.00">
                                </div>
                            </div>

                            {{-- Primera línea activa --}}
                            <div class="row factura-linea mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">Explotación:</label>
                                    <select class="form-select selectExplotacion" name="explotacion_id[]" required>
                                        <option value="" disabled selected>Elige explotación</option>
                                        @foreach ($explotaciones as $explo)
                                            <option value="{{ $explo->id }}">
                                                {{ $explo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Cultivo:</label>
                                    <select class="form-select selectCultivo" name="cultivo_id[]" required disabled>
                                        <option value="" disabled>
                                            Selecciona explotación primero
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control" name="cantidad[]" min="0"
                                        step="0.01" required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Precio unidad:</label>
                                    <input type="number" class="form-control" name="precio_unitario[]" min="0"
                                        step="0.01" required>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger quitarLinea">
                                        -
                                    </button>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <span class="subtotal-visible">0.00</span>
                                    <input type="hidden" name="subtotal[]" value="0.00">
                                </div>
                            </div>
                        </div>

                        <button type="button" id="agregarLinea" class="btn btn-secondary mb-3">
                            Agregar línea
                        </button>

                        {{-- Totales visibles --}}
                        <div class="mb-3 text-end">
                            <h5>Total Neto: <span id="totalNeto">0.00</span></h5>
                            <h5>Impuestos (21%): <span id="totalImpuestos">0.00</span></h5>
                            <h4>Total: <span id="totalFactura">0.00</span></h4>
                        </div>

                        {{-- Inputs ocultos para enviar totales al controlador --}}
                        <input type="hidden" id="inputNeto" name="neto" value="0.00">
                        <input type="hidden" id="inputImpuestos" name="impuestos" value="0.00">
                        <input type="hidden" id="inputTotal" name="total" value="0.00">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" form="formCrearFactura">
                        Guardar factura
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
