@extends('explotacion')

@section('content2')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




<div class="w-50 ms-2">

    <div class="d-flex flex-row align-items-center align-content-center h-75">

        <canvas id="graficoOrdenes" width="10" height="10"></canvas>

        <div class="resumen mt-5 pt-5">
            <div class="align-items-center p-2">
                <div class="resumen-g-card" style="background-color: rgb(0, 66, 21) !important; color:white;">
                    <h6>Pendientes</h6>
                    <div class="cantidad">{{ $todasOrdenes['pendientes'] }}</div>
                </div>
                <div class="resumen-g-card" style="background-color: rgb(14, 217, 69) !important; color:black;">
                    <h6>En curso</h6>
                    <div class="cantidad">{{ $todasOrdenes['enCurso'] }}</div>
                </div>
                <div class="resumen-g-card"style="background-color: rgb(216, 255, 226) !important; color:black;">
                    <h6>Pausadas</h6>
                    <div class="cantidad">{{ $todasOrdenes['pausadas'] }}</div>
                </div>
            </div>

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
                title: {
                    display: true,
                    text: 'Resumen total de órdenes',
                    font: {
                        size: 20
                    }
                }
            }
        }
    });
</script>

@endsection
