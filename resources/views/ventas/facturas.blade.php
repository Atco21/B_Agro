@extends('ventas')

@section('content3')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Cargar historial de facturas (usando la ruta web de controlador)
            fetch('http://192.168.31.27:8000/api/facturas')
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
                            <td>${f.estado}</td>
                            <td>
                                <a href="/facturas/${f.id}" class="btn btn-sm btn-info">Ver</a>
                                <a href="/facturas/${f.id}/pdf" class="btn btn-sm btn-success ms-1">Generar PDF</a>
                                <button
                                    class="btn btn-sm btn-warning ms-1 btnCambiarEstado"
                                    data-id="${f.id}"
                                    data-estado="${f.estado}"
                                >Cambiar Estado</button>
                            </td>
                        </tr>`;
                    });
                });

            // Delegación para abrir modal de cambiar estado
            document.querySelector('#historialFacturas tbody').addEventListener('click', e => {
                if (!e.target.classList.contains('btnCambiarEstado')) return;
                const id = e.target.dataset.id;
                const estadoActual = e.target.dataset.estado;
                const modalEl = document.getElementById('modalCambiarEstado');
                const modal = new bootstrap.Modal(modalEl);

                document.getElementById('cambiarEstadoFacturaId').value = id;
                const selectEstado = document.getElementById('selectEstadoModal');
                selectEstado.value = estadoActual;

                document.getElementById('formCambiarEstado').action = `/facturas/${id}/cambiar-estado`;

                modal.show();
            });

            const container = document.getElementById('lineasFacturaContainer');

            // Función para recalcular neto, impuestos y total
            function calcularTotales() {
                let neto = 0;
                container.querySelectorAll('.factura-linea').forEach(row => {
                    const cantidad = parseFloat(row.querySelector('input[name="cantidad[]"]').value) || 0;
                    const precio = parseFloat(row.querySelector('input[name="precio_unitario[]"]').value) || 0;
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
                document.getElementById('inputNeto').value = neto.toFixed(2);
                document.getElementById('inputImpuestos').value = impuestos.toFixed(2);
                document.getElementById('inputTotal').value = total.toFixed(2);
            }

            // Agregar nueva línea
            document.getElementById('agregarLinea').addEventListener('click', () => {
                const template = container.querySelector('.factura-linea.template');
                const newLinea = template.cloneNode(true);
                newLinea.classList.remove('template');
                newLinea.querySelectorAll('select, input').forEach(input => {
                    if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0;
                        if (input.classList.contains('selectCultivo')) {
                            input.innerHTML = '<option value="" disabled selected>Selecciona explotación primero</option>';
                            input.disabled = true;
                        }
                    } else {
                        if (input.name === 'cantidad[]' || input.name === 'precio_unitario[]') {
                            input.value = '';
                        }
                        if (input.name === 'subtotal[]') {
                            input.value = '0.00';
                        }
                    }
                });
                container.appendChild(newLinea);
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

            // Carga cultivos según explotación
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
                        options += `<option value="${item.cultivo.id}">${item.cultivo.nombre} (Stock: ${item.stock})</option>`;
                    });
                    cultivoSelect.innerHTML = options;
                    cultivoSelect.disabled = false;
                } catch (err) {
                    cultivoSelect.innerHTML = '<option>Error</option>';
                    console.error(err);
                }
            });

            // Recalcular totales al cambiar cantidad o precio
            container.addEventListener('input', e => {
                if (e.target.name === 'cantidad[]' || e.target.name === 'precio_unitario[]') {
                    calcularTotales();
                }
            });

            // Al enviar el formulario de creación, ajustar totales finales
            document.getElementById('formCrearFactura').addEventListener('submit', e => {
                calcularTotales();
            });
        });
    </script>

    <div class="w-100 p-5">
        <div class="d-flex">
            <div class="d-flex justify-content-between align-items-center mb-4 w-75">
                <h1>Pedidos</h1>
                <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalCrearFactura">
                    Crear pedido
                </button>
            </div>
        </div>
        <div class="row ps-2">
            <table class="table w-75" id="historialFacturas">
                <thead>
                    <tr>
                        <th class="th_verde_primero">Cliente</th>
                        <th class="th_verde">Total</th>
                        <th class="th_verde">Fecha</th>
                        <th class="th_verde">Estado</th>
                        <th class="th_verde">Opciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalCrearFactura" tabindex="-1" aria-labelledby="modalCrearFacturaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 900px">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearFacturaLabel">Crear nuevo pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearFactura" action="{{ route('facturas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="numeroFactura" class="form-label">Número:</label>
                            <input type="text" id="numeroFactura" name="numero" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="selectCliente" class="form-label">Cliente:</label>
                            <select id="selectCliente" class="form-select" name="cliente_id" required>
                                <option value="" disabled selected>Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFactura" class="form-label">Fecha:</label>
                            <input type="date" id="fechaFactura" class="form-control" name="fecha" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipoPago" class="form-label">Tipo de pago:</label>
                            <select id="tipoPago" class="form-select" name="tipo_pago" required>
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estadoFactura" class="form-label">Estado:</label>
                            <select id="estadoFactura" class="form-select" name="estado" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="pagada">Pagada</option>
                                <option value="vencida">Vencida</option>
                            </select>
                        </div>

                        <div id="lineasFacturaContainer">
                            <div class="row factura-linea mb-3 template">
                                <div class="col-md-3">
                                    <label class="form-label">Explotación:</label>
                                    <select class="form-select selectExplotacion" name="explotacion_id[]" required>
                                        <option value="" disabled selected>Elige explotación</option>
                                        @foreach ($explotaciones as $explo)
                                            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Cultivo:</label>
                                    <select class="form-select selectCultivo" name="cultivo_id[]" required disabled>
                                        <option value="" disabled>Selecciona explotación primero</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control" name="cantidad[]" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Precio unidad:</label>
                                    <input type="number" class="form-control" name="precio_unitario[]" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger quitarLinea">-</button>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <span class="subtotal-visible">0.00</span>
                                    <input type="hidden" name="subtotal[]" value="0.00">
                                </div>
                            </div>

                            <div class="row factura-linea mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">Explotación:</label>
                                    <select class="form-select selectExplotacion" name="explotacion_id[]" required>
                                        <option value="" disabled selected>Elige explotación</option>
                                        @foreach ($explotaciones as $explo)
                                            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Cultivo:</label>
                                    <select class="form-select selectCultivo" name="cultivo_id[]" required disabled>
                                        <option value="" disabled>Selecciona explotación primero</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control" name="cantidad[]" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Precio unidad:</label>
                                    <input type="number" class="form-control" name="precio_unitario[]" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger quitarLinea">-</button>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <span class="subtotal-visible">0.00</span>
                                    <input type="hidden" name="subtotal[]" value="0.00">
                                </div>
                            </div>
                        </div>

                        <button type="button" id="agregarLinea" class="btn btn-secondary mb-3">Agregar línea</button>

                        <div class="mb-3 text-end">
                            <h5>Total Neto: <span id="totalNeto">0.00</span></h5>
                            <h5>Impuestos (21%): <span id="totalImpuestos">0.00</span></h5>
                            <h4>Total: <span id="totalFactura">0.00</span></h4>
                        </div>

                        <input type="hidden" id="inputNeto" name="neto" value="0.00">
                        <input type="hidden" id="inputImpuestos" name="impuestos" value="0.00">
                        <input type="hidden" id="inputTotal" name="total" value="0.00">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" form="formCrearFactura">Guardar pedido</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCambiarEstado" tabindex="-1" aria-labelledby="modalCambiarEstadoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCambiarEstadoLabel">Cambiar estado de factura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formCambiarEstado" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="cambiarEstadoFacturaId" name="factura_id" value="">
                        <div class="mb-3">
                            <label for="selectEstadoModal" class="form-label">Nuevo estado:</label>
                            <select id="selectEstadoModal" name="estado" class="form-select" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="pagada">Pagada</option>
                                <option value="vencida">Vencida</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning" form="formCambiarEstado">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
