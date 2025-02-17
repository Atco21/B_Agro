@extends('explotacion')

@section('content2')

<script>

addEventListener('DOMContentLoaded', inicio);

function inicio() {

    const select = document.querySelector(".exploSelect");

    if (select) {
        select.addEventListener("change", function() {
            const id = select.value;
            if (id) {
                cargarDatos(id);
                actualizarURL(id);
            }
        });
    }


}

async function cargarDatos(id) {
    fetch(`/api/ordenes/explotacion/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("No hay datos");
            } else {
                document.getElementById('secciones').removeAttribute('hidden');
                actualizarContenido(data);
            }
        })
        .catch(error => console.error("ErrormostrarOrdenesPorExplotacion en la petición:", error));
}



</script>


<div id="previo" hidden>

    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">

    <h2>Selecciona una explotación</h2>

    </div>

</div>

<div id="ordenes">

    <table class="table">

        <thead>
            <tr>
                <td>En curso</td>
                <td>Pendientes</td>
                <td>Pausadas</td>
            </tr>
        </thead>


    </table>

</div>





@endsection
