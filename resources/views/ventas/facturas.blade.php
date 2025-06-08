@extends('ventas')

@section('content3')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let facturasData = [];

            // Cargar historial de facturas (JSON)
            fetch('http://192.168.31.27:8000/api/facturas')
                .then(res => res.json())
                .then(facturas => {
                    facturasData = facturas;
                    const tbody = document.querySelector('#historialFacturas tbody');
                    tbody.innerHTML = '';
                    facturas.forEach(f => {
                        tbody.innerHTML += `
                        <tr>
                            <td>${f.cliente.nombre_completo}</td>
                            <td>${parseFloat(f.total).toFixed(2)}</td>
                            <td>${new Date(f.fecha).toLocaleDateString()}</td>
                            <td>
                                <button class="btn btn-sm btn-info ver-factura-btn" data-id="${f.id}">Ver factura</button>
                                <button class="btn btn-sm btn-warning editar-estado-btn" data-id="${f.id}">Editar estado</button>
                                <a href="/facturas/${f.id}/pdf" class="btn btn-sm btn-success">Generar PDF</a>
                            </td>
                        </tr>`;
                    });
                })
                .catch(err => console.error('Error al cargar facturas:', err));

            // Delegación de eventos
            const tbody = document.querySelector('#historialFacturas tbody');
            tbody.addEventListener('click', e => {
                const btn = e.target;
                const id = btn.dataset.id;
                if (!id) return;

                const factura = facturasData.find(x => x.id == id);
                if (!factura) return;

                // Ver factura
                if (btn.classList.contains('ver-factura-btn')) {
                    document.getElementById('modalVerNumero').textContent = factura.numero || factura.id;
                    document.getElementById('modalVerCliente').textContent = factura.cliente.nombre_completo;
                    document.getElementById('modalVerTotal').textContent = parseFloat(factura.total).toFixed(2);
                    // Lineas
                    const body = document.getElementById('modalVerLineasBody');
                    body.innerHTML = '';
                    factura.lineas.forEach(l => {
                        body.innerHTML += `
                          <tr>
                            <td>${l.explotacion.nombre}</td>
                            <td>${l.cultivo.nombre}</td>
                            <td>${parseFloat(l.cantidad).toFixed(2)}</td>
                            <td>${parseFloat(l.precio_unitario).toFixed(2)}</td>
                            <td>${parseFloat(l.subtotal).toFixed(2)}</td>
                          </tr>`;
                    });
                    new bootstrap.Modal(document.getElementById('modalVerFactura')).show();
                }

                // Editar estado
                if (btn.classList.contains('editar-estado-btn')) {
                    const form = document.getElementById('formEditarEstado');
                    form.action = `/facturas/${id}`;
                    document.getElementById('modalEditNumero').textContent = factura.numero || factura.id;
                    document.getElementById('modalEditCliente').textContent = factura.cliente.nombre_completo;
                    document.getElementById('modalEditTotal').textContent = parseFloat(factura.total).toFixed(2);
                    document.getElementById('selectModalEstado').value = factura.estado;
                    new bootstrap.Modal(document.getElementById('modalEditarEstado')).show();
                }
            });
        });
    </script>

    <div class="w-100 p-5">
        <h1>Pedidos</h1>
        <table class="table w-75 mt-4" id="historialFacturas">
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

    {{-- Modal Ver Factura --}}
    <div class="modal fade" id="modalVerFactura" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Factura <span id="modalVerNumero"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>Cliente:</strong> <span id="modalVerCliente"></span></p>
            <p><strong>Total:</strong> € <span id="modalVerTotal"></span></p>
            <hr>
            <h6>Líneas de factura:</h6>
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Explotación</th>
                  <th>Cultivo</th>
                  <th>Cantidad</th>
                  <th>Precio unitario</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody id="modalVerLineasBody">
                {{-- Se llenará vía JS --}}
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal Editar Estado --}}
    <div class="modal fade" id="modalEditarEstado" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="formEditarEstado" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title">Editar estado de factura <span id="modalEditNumero"></span></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p><strong>Cliente:</strong> <span id="modalEditCliente"></span></p>
              <p><strong>Total:</strong> € <span id="modalEditTotal"></span></p>
              <div class="mb-3">
                <label for="selectModalEstado" class="form-label">Estado</label>
                <select id="selectModalEstado" name="estado" class="form-select" required>
                  <option value="pendiente">Pendiente</option>
                  <option value="pagada">Pagada</option>
                  <option value="vencida">Vencida</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
