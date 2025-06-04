@extends('explotacion')

@section('content2')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <div class="d-flex flex-row ms-5">
        <div class="ms-2 col-md-5">

            <div class="d-flex flex-column align-items-center align-content-center h-25">
                <h3>Resumen total órdenes para hoy</h3>
                <div class="d-flex flex-row" style="height: 250px !important;">
                    <canvas id="graficoOrdenes"></canvas>

                    <div class="resumen">
                        <div class="align-items-center p-2">
                            <div class="resumen-g-tarjeta" style="background-color: rgb(0, 66, 21) !important; color:white;">
                                <h6>Pendientes</h6>
                                <div class="cantidad">{{ $todasOrdenes['pendientes'] }}</div>
                            </div>
                            <div class="resumen-g-tarjeta" style="background-color: rgb(14, 217, 69) !important; color:black;">
                                <h6>En curso</h6>
                                <div class="cantidad">{{ $todasOrdenes['enCurso'] }}</div>
                            </div>
                            <div class="resumen-g-tarjeta"style="background-color: rgb(216, 255, 226) !important; color:black;">
                                <h6>Pausadas</h6>
                                <div class="cantidad">{{ $todasOrdenes['pausadas'] }}</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



        </div>

        <div class="col-md-5 text-center">
            <h4>Listado de químicos en ruptura</h4>

            @if ($quimicosPeligro->isEmpty())
                <p>No hay químicos con ruptura actualmente.</p>
            @else
                <table class="table table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th class="th_verde_primero">Nombre</th>
                            <th class="th_verde">Almacén</th>
                            <th class="th_verde">Stock</th>
                            <th class="th_verde">Stock Mínimo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quimicosPeligro as $q)
                            <tr>
                                <td>{{ $q->quimico->nombre ?? 'Sin nombre' }}</td>
                                <td>{{ $q->almacen->nombre ." ". $q->almacen->explotacion->nombre}}</td>
                                <td>{{ $q->stock }}</td>
                                <td>{{ $q->stock_minimo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    <div class="d-flex flex-row ms-5">


        <div class=" pt-5 mt-5 text-center col-md-5" id="incidenciasPorExplotacion">
            <h3 class="">Incidencias por explotación</h3>
            <div class="col">
                @foreach($explotacion as $exp)
                    @php
                        $count = $incidenciasCounts[$exp->id] ?? 0;
                    @endphp
                    <div class="align-items-center justify-content-center m-2">
                        <div class="tarjeta-info">
                            <div class="text-center">
                                <h4>{{ $exp->nombre }} <incidencia class="p-2"><strong>{{ $count }}</strong></incidencia></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        const resumen = @json($todasOrdenes);

        const ctx = document.getElementById('graficoOrdenes').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'Número de órdenes',
                    data: [
                        resumen.pendientes,
                        resumen.enCurso,
                        resumen.pausadas,
                    ],
                    backgroundColor: [

                        'rgb(0, 66, 21)',
                        'rgb(14, 217, 69)',
                        'rgb(216, 255, 226)',
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 0.5)',
                        'rgba(0, 0, 0, 0.5)',
                        'rgba(0, 0, 0, 0.5)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    // title: {
                    //     display: true,
                    //     text: 'Resumen total de órdenes',
                    //     font: {
                    //         size: 20
                    //     }
                    // }
                }
            }
        });
    </script>

@endsection
