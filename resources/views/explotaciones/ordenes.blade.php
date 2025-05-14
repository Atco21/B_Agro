@extends('explotacion')

@section('content2')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

addEventListener('DOMContentLoaded', inicio);

function inicio() {

    const select = document.querySelector(".exploSelect");
    document.getElementById('ordenes').setAttribute('hidden', '');
    document.getElementById('previo').removeAttribute('hidden');
    if (select) {
        select.selectedIndex = 0;

        select.addEventListener("change", function() {
            const id = select.value;
            if (id) {
                cargarDatos(id);
                actualizarURL(id);
            }
        });
    }
    history.replaceState({}, "", "/explotaciones/ordenes/");


}

function actualizarURL(id_explo) {
    const newURL = `/explotaciones/ordenes/${id_explo}`;
    history.pushState({ id: id_explo }, "", newURL);
}
window.onpopstate = function(event) {
    if (event.state && event.state.id) {
        cargarDatos(event.state.id);

        // Sincroniza visualmente el <select>
        const select = document.querySelector(".exploSelect");
        if (select) {
            select.value = event.state.id;
        }
    } else {
        // Si vuelves al estado inicial (sin ID)
        const select = document.querySelector(".exploSelect");
        if (select) {
            select.selectedIndex = 0;
        }

        document.getElementById('ordenes').setAttribute('hidden', '');
        document.getElementById('previo').removeAttribute('hidden');
    }
};
async function cargarDatos(id) {
    fetch(`/api/ordenes/explotacion/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("No hay datos");
            } else {
                document.getElementById('ordenes').removeAttribute('hidden');
                document.getElementById('previo').setAttribute('hidden','');

                actualizarContenido(data);
            }
        })
        .catch(error => console.error("ErrormostrarOrdenesPorExplotacion en la petición:", error));
}



async function actualizarContenido(data){
    const tbody = document.querySelector("#ordenes tbody");
    tbody.innerHTML = ""; // Limpiar el contenido actual
    let pendientes = [];
    let enCurso = [];
    let pausadas = [];
    let completadas = [];
    data.forEach(orden => {
        switch (orden.estado) {
            case 'pendiente':
                pendientes.push(orden);
                break;
            case 'en curso':
                enCurso.push(orden);
                break;
            case 'pausada':
                pausadas.push(orden);
                break;
            case 'completada':
                completadas.push(orden);
                break;
        }
    });

    for (let i = 0; i < Math.max(pendientes.length, enCurso.length, pausadas.length, completadas.length); i++) {
        const tr = document.createElement("tr");
        console.log("pendientes", pendientes);
        tr.innerHTML = `
            <td class="text-center border-2" >${pendientes[i] ? pendientes[i].tarea : ''}</td>
            <td class="text-center border-2" >${enCurso[i] ? enCurso[i].tarea : ''}</td>
            <td class="text-center border-2" >${pausadas[i] ? pausadas[i].tarea : ''}</td>
        `;
        tbody.appendChild(tr);
    }


}

</script>

<div id="previo">

    <div class="d-flex">

        <div class="ms-5">
            {{-- <canvas id="graficoOrdenes" width="400" height="200"></canvas> --}}

            <h2 class="mb-3">Resumen de órdenes por explotación</h2>
            @foreach ($explotacion as $exp)
                @php
                    $resumen = $ordenes[$exp->id] ?? ['pendientes' => 0, 'enCurso' => 0, 'pausadas' => 0, 'completadas' => 0];
                @endphp

                <h3 class="mt-4 mb-2">{{ $exp->nombre }}</h3>
                <div class="resumen">
                    <div class="resumen-card">
                        <h6>En curso</h6>
                        <div class="cantidad">{{ $resumen['enCurso'] }}</div>
                    </div>
                    <div class="resumen-card">
                        <h6>Pendientes</h6>
                        <div class="cantidad">{{ $resumen['pendientes'] }}</div>
                    </div>
                    <div class="resumen-card">
                        <h6>Pausadas</h6>
                        <div class="cantidad">{{ $resumen['pausadas'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>




        {{-- @foreach ($explotacion as $exp)
        @php
            $resumen = $ordenes[$exp->id] ?? ['pendientes' => 0, 'enCurso' => 0, 'pausadas' => 0, 'completadas' => 0];
        @endphp

        <h4>{{ $exp->nombre }}</h4>
        <ul>
            <li>Pendientes: {{ $resumen['pendientes'] }}</li>
            <li>En curso: {{ $resumen['enCurso'] }}</li>
            <li>Pausadas: {{ $resumen['pausadas'] }}</li>
            <li>Completadas: {{ $resumen['completadas'] }}</li>
        </ul>
        @endforeach --}}


    </div>

</div>

<div id="ordenes" class="ms-5 me-5" hidden>

    <div class="d-flex">
        <table class="table" style="border">
            <thead class="table-dark">
                <tr>
                    <td class="text-center">Pendientes</td>
                    <td class="text-center">En curso</td>
                    <td class="text-center">Pausadas</td>
                    <td class="text-center">Completadas</td>
                </tr>

            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</div>






@endsection
