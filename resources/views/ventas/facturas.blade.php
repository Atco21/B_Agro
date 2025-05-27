@extends('ventas')

@section('content3')
    <div class="w-100 m-2 p-5">
        <div class="d-flex">
            <div class="flex-row w-100">
                <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalCrearFactura">
                    Crear factura
                </button>

                <div class="mt-5">
                    <h3>Historial de facturación</h3>
                    <table class="table w-75" id="historialFacturas">
                        <thead>
                            <tr>
                                <th class="th_verde_primero">Cliente</th>
                                <th class="th_verde">Total</th>
                                <th class="th_verde">Fecha</th>
                                <th class="th_verde">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Se llenará vía JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear factura -->
    <div class="modal fade" id="modalCrearFactura" tabindex="-1" aria-labelledby="modalCrearFacturaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: 900px">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearFacturaLabel">Crear nueva factura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearFactura">
                        @csrf

                        <!-- Selección de cliente -->
                        <div class="mb-3">
                            <label for="selectCliente" class="form-label">Cliente:</label>
                            <select id="selectCliente" class="form-select" name="cliente_id" required>
                                <option value="" disabled selected>Selecciona un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="mb-3">
                            <label for="fechaFactura" class="form-label">Fecha:</label>
                            <input type="date" id="fechaFactura" class="form-control" name="fecha"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        <!-- Líneas de factura -->
                        <div id="lineasFacturaContainer">
                            <div class="row factura-linea mb-3">
                                <!-- Select Almacén -->
                                <div class="col-md-4">
                                    <label class="form-label">Almacén:</label>
                                    <select class="form-select selectAlmacen" name="lineas[0][almacen_id]" required>
                                        <option value="" disabled selected>Elige almacén</option>
                                        @foreach ($almacenes as $almacen)
                                            <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select Cultivo (vacío inicialmente) -->
                                <div class="col-md-2">
                                    <label class="form-label">Cultivo:</label>
                                    <select class="form-select selectCultivo" name="lineas[0][cultivo_id]" required
                                        disabled>
                                        <option value="" disabled>Selecciona antes el almacén</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Cantidad:</label>
                                    <input type="number" class="form-control" name="lineas[0][cantidad]" min="1"
                                        required>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Precio unidad:</label>
                                    <input type="number" class="form-control" name="lineas[0][precioUnidad]" min="1"
                                        required>
                                </div>

                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger quitarLinea">-</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="agregarLinea" class="btn btn-secondary mb-3">Agregar línea</button>

                        <div class="mb-3 text-end">
                            <h5>Total Neto: <span id="totalNeto">0.00</span></h5>
                            <h5>Impuestos (21%): <span id="totalImpuestos">0.00</span></h5>
                            <h4>Total: <span id="totalFactura">0.00</span></h4>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="guardarFactura" class="btn btn-primary">Guardar factura</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Cargar historial de facturas
            fetch('/api/facturas')
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
                  <td><button class="btn btn-sm btn-info">Ver</button></td>
                </tr>`;
                    });
                });

            let lineaIndex = 1;
            const container = document.getElementById('lineasFacturaContainer');

            // Agregar nueva línea
            document.getElementById('agregarLinea').addEventListener('click', () => {
                const newLinea = container.querySelector('.factura-linea').cloneNode(true);
                newLinea.querySelectorAll('select, input').forEach(input => {
                    const name = input.getAttribute('name');
                    input.setAttribute('name', name.replace(/\d+/, lineaIndex));
                    if (input.tagName === 'INPUT') input.value = '';
                    if (input.classList.contains('selectCultivo')) {
                        input.innerHTML =
                            '<option disabled selected>Selecciona antes el almacén</option>';
                        input.disabled = true;
                    }
                });
                container.appendChild(newLinea);
                lineaIndex++;
            });

            // Quitar línea
            container.addEventListener('click', e => {
                if (e.target.classList.contains('quitarLinea')) {
                    const lineas = container.querySelectorAll('.factura-linea');
                    if (lineas.length > 1) e.target.closest('.factura-linea').remove();
                }
            });

            // Calcular totales
            container.addEventListener('input', calcularTotales);

            function calcularTotales() {
                let neto = 0;
                container.querySelectorAll('.factura-linea').forEach(row => {
                    const cant = parseFloat(row.querySelector('input[name*="cantidad"]').value) || 0;
                    const precio = parseFloat(row.querySelector('input[name*="precio_unitario"]').value) ||
                        0;
                    neto += cant * precio;
                });
                const impuestos = neto * 0.21;
                document.getElementById('totalNeto').textContent = neto.toFixed(2);
                document.getElementById('totalImpuestos').textContent = impuestos.toFixed(2);
                document.getElementById('totalFactura').textContent = (neto + impuestos).toFixed(2);
            }

            // Listener para cambio de almacén: cargar cultivos
            container.addEventListener('change', async e => {
                if (!e.target.classList.contains('selectAlmacen')) return;
                const almacenId = e.target.value;
                const lineaDiv = e.target.closest('.factura-linea');
                const cultivoSelect = lineaDiv.querySelector('.selectCultivo');

                cultivoSelect.innerHTML = '<option>Cargando...</option>';
                cultivoSelect.disabled = true;

                try {
                    const res = await fetch(`/api/almacen/cosecha/${almacenId}`);
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

            // Guardar factura
            document.getElementById('guardarFactura').addEventListener('click', () => {
                const form = document.getElementById('formCrearFactura');
                const data = new FormData(form);
                fetch('/api/facturas', {
                        method: 'POST',
                        body: data
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if (resp.id) location.reload();
                        else alert('Error al guardar factura');
                    });
            });
        });
    </script>
@endsection
