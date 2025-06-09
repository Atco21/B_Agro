@extends('layouts.app')

@section('content')
    @if ($explotacion->count() > 0)
        <div class="d-flex flex-row vh-100 w-100 overflow-hidden">
            <!-- Menú lateral -->
            <div class="col-2 d-flex flex-column justify-content-start align-items-center pt-5" id="barra">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="menu2 nav-link {{ Request::is('*general*') ? 'active2' : '' }}"
                            href="{{ url('explotaciones/general') }}">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="menu2 nav-link {{ Request::is('*parcelas*') ? 'active2' : '' }}"
                            href="{{ url('explotaciones/parcelas') }}">Parcelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="menu2 nav-link {{ Request::is('*ordenes*') ? 'active2' : '' }}"
                            href="{{ url('explotaciones/ordenes') }}">Órdenes</a>
                    </li>
                    <li class="nav-item">
                        <a class="menu2 nav-link {{ Request::is('*maquinas*') ? 'active2' : '' }}"
                            href="{{ url('explotaciones/maquinas') }}">Máquinas</a>
                    </li>
                    <li class="nav-item">
                        <a class="menu2 nav-link {{ Request::is('*almacen*') ? 'active2' : '' }}"
                            href="{{ url('explotaciones/almacen') }}">Almacén</a>
                    </li>
                    <li class="nav-item">
                        <a class="menu2 nav-link {{ Request::is('*incidencias*') ? 'active2' : '' }}"
                            href="{{ url('explotaciones/incidencias') }}">Incidencias</a>
                    </li>
                </ul>
            </div>

            <div class="col-11 d-flex flex-column h-100 pe-5">
                <div id="nuevoBoton" class="d-flex justify-content-end align-items-center gap-3 p-3 pe-4 ms-auto" hidden>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearexplotacion"
                        id="btnNuevaExplotacion">
                        + Nueva Explotación
                    </button>
                </div>

                @yield('content2')
            </div>
        </div>
    @else
        <div class="d-flex align-items-center justify-content-center" style="height: 75vh;">
            <div class="text-center">
                <h2 class="mb-3">No hay explotaciones</h2>
                <button type="button" class="btn btn-primary p-3" data-bs-toggle="modal" data-bs-target="#crearexplotacion"
                    id="btnCrearExplotacion">
                    Crear Explotación
                </button>
            </div>
        </div>
    @endif

    <div class="modal fade" id="crearexplotacion" tabindex="-1" aria-labelledby="crearexplotacionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formCrearExplotacion" method="POST" action="{{ route('explotaciones.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearexplotacionLabel">Nueva explotación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label for="nombreExplotacion" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombreExplotacion" name="nombre" required>
                            </div>
                            <div class="col-md-3">
                                <label for="direccionExplotacion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccionExplotacion" name="direccion">
                            </div>
                            <div class="col-md-3">
                                <label for="localidadExplotacion" class="form-label">Localidad</label>
                                <input type="text" class="form-control" id="localidadExplotacion" name="localidad">
                            </div>
                            <div class="col-md-3">
                                <label for="tamanyoExplotacion" class="form-label">Tamaño (ha)</label>
                                <input type="number" class="form-control" id="tamanyoExplotacion" name="tamanyo"
                                    min="0" step="0.1">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Parcelas</h6>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="btnAgregarParcela">
                                + Añadir Parcela
                            </button>
                        </div>
                        <div id="parcelasContainer">
                            <div class="row mb-3 parcela_linea template">
                                <div class="col-md-4">
                                    <label class="form-label">Nombre Parcela</label>
                                    <input type="text" class="form-control" name="parcelas[__i__][nombre]" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Cultivo</label>
                                    <select class="form-select" name="parcelas[__i__][cultivo_id]" required>
                                        <option value="" disabled selected>Selecciona cultivo</option>
                                        @foreach ($cultivos as $cultivo)
                                            <option value="{{ $cultivo->id }}">{{ $cultivo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tamaño (ha)</label>
                                    <input type="number" class="form-control" name="parcelas[__i__][tamanyo]"
                                        min="0" step="0.1" required>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-eliminar-parcela">×</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear explotación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('parcelasContainer');
            const btnAgregar = document.getElementById('btnAgregarParcela');
            let parcelaIndex = 0;

            btnAgregar.addEventListener('click', () => {
                const template = container.querySelector('.parcela_linea.template');
                const nueva = template.cloneNode(true);
                nueva.classList.remove('template');
                nueva.innerHTML = nueva.innerHTML.replace(/__i__/g, parcelaIndex);
                nueva.querySelectorAll('input, select').forEach(el => {
                    el.value = '';
                });
                container.appendChild(nueva);
                parcelaIndex++;
            });
            container.addEventListener('click', e => {
                if (e.target.classList.contains('btn-eliminar-parcela')) {
                    const lineas = container.querySelectorAll('.parcela_linea:not(.template)');
                    if (lineas.length > 0) {
                        e.target.closest('.parcela_linea').remove();
                    }
                }
            });
        });
    </script>
@endsection
