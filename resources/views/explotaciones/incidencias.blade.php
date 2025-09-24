@extends('explotacion')

@section('content2')
    <script>
        document.addEventListener('DOMContentLoaded', inicio);
        document.getElementById('btnNuevaExplotacion').setAttribute('hidden', '');


        function inicio() {
            document.getElementById('previo').removeAttribute('hidden');
            document.getElementById('incidencias').setAttribute('hidden', '');

            const select = document.querySelector('.exploSelect');
            if (select) {
                select.selectedIndex = 0;
                select.addEventListener('change', () => {
                    const id = select.value;
                    if (id) {
                        document.getElementById('previo').setAttribute('hidden', '');
                        document.getElementById('incidencias').removeAttribute('hidden');
                        cargarIncidencias(id);
                        actualizarURL(id);
                    }
                });
            }

            window.onpopstate = function(event) {
                if (event.state?.id) {
                    cargarIncidencias(event.state.id);
                    document.querySelector('.exploSelect').value = event.state.id;
                    document.getElementById('previo').setAttribute('hidden', '');
                    document.getElementById('incidencias').removeAttribute('hidden');
                } else {
                    document.getElementById('previo').removeAttribute('hidden');
                    document.getElementById('incidencias').setAttribute('hidden', '');
                }
            };
        }

        function actualizarURL(id) {
            history.pushState({
                id
            }, '', `/explotaciones/incidencias/${id}`);
        }

        async function cargarIncidencias(id) {
            const res = await fetch(`/api/incidencias/explotacion/${id}`);
            const data = await res.json();
            const tbody = document.getElementById('tablaIncidencias');
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4">No hay incidencias.</td></tr>';
            } else {
                data.forEach(inc => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${inc.id}</td>
                            <td>${inc.tipo}</td>
                            <td>${inc.descripcion}</td>
                            <td>${inc.fecha}</td>
                        </tr>`;
                });
            }
        }
    </script>

    <div class="ms-5 mt-5" id="previo">
        <h1 class="mb-4">Resumen de incidencias por explotación</h1>
        <div class="row">

            @foreach ($explotacion as $exp)

                @php
                    $cnt = $incidenciasCounts[$exp->id] ?? ['Personal' => 0, 'Stock' => 0, 'Maquina' => 0];
                @endphp
                <div class="col-md-3 mb-3">
                    <div class="card h-100 incidencia-tarjeta" data-id="{{ $exp->id }} ">
                        <div class="text-center pt-3">
                            <h2>{{ $exp->nombre }}</h2>
                        </div>
                        <div class="resumen d-flecx flex-column">
                            <div class="incidencia-resumen-tarjeta">

                                <h3>Personal: <strong>{{ $cnt['Personal'] }}</strong></h3>
                            </div>

                            <div class="incidencia-resumen-tarjeta ">
                                <h3>Stock: <strong>{{ $cnt['Stock'] }}</strong></h3>
                            </div>
                            <div class="incidencia-resumen-tarjeta">
                                <h3>Máquina: <strong>{{ $cnt['Maquina'] }}</strong></h3>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>

    <div class="ms-5" id="incidencias">
        <h3 class="mb-4">Listado de Incidencias</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="tablaIncidencias"></tbody>
        </table>
    </div>
@endsection
