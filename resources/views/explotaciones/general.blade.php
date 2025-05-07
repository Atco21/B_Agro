@extends('explotacion')

@section('content2')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="d-flex flex-row justify-content-between">

    <div class="w-25 h-100 ms-5">
        <canvas id="graficoOrdenes" width="200" height="100"></canvas>

    </div>
    <div class="resumen ms-5 mt-4 me-5">
        <div class="d-flex align-items-center">
            <h2 class="me-4">Ordenes</h2>

            <div class="resumen-g-card">
                <h6>Pendientes</h6>
                <div class="cantidad">{{ $todasOrdenes['pendientes'] }}</div>
            </div>
            <div class="resumen-g-card">
                <h6>En curso</h6>
                <div class="cantidad">{{ $todasOrdenes['enCurso'] }}</div>
            </div>
            <div class="resumen-g-card">
                <h6>Pausadas</h6>
                <div class="cantidad">{{ $todasOrdenes['pausadas'] }}</div>
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
            labels: ['Pendientes', 'En curso', 'Pausadas'],
            datasets: [{
                label: 'Número de órdenes',
                data: [
                    resumen.pendientes,
                    resumen.enCurso,
                    resumen.pausadas,
                ],
                backgroundColor: [
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(201, 203, 207, 0.8)',
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Resumen total de órdenes'
                }
            }
        }
    });
</script>

@endsection
