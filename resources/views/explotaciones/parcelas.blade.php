@extends('explotacion')

@section('content2')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const select = document.querySelector(".expoSelect");

        if (select) {
            select.addEventListener("change", function() {
                const id = select.value;
                if (id) {
                    cargarDatos(id);
                    actualizarURL(id);
                }
            });
        }
    });

    function cargarDatos(id) {
        console.log(`Cargando datos para explotación ID: ${id}`);




        fetch(`/api/parcelas/explotacion/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("No hay datos");
                } else {
                    console.log("Datos recibidos:", data);
                    actualizarContenido(data);
                }
            })
            .catch(error => console.error("Error en la petición:", error));
    }

    async function actualizarContenido(data) {
        const contentDiv = document.getElementById("tabla");

        const idsCultivos = data.map(parcela => parcela.cultivo_id);
        let cultivosNombre = {};

        alert(idsCultivos);

        try {
            const response = await fetch(`/api/cultivos_nombre/${idsCultivos.join(",")}`);
            const cultivosData = await response.json();

            if (cultivosData.error) {
                alert("No hay datos disponibles");
                return;
            }
            console.log(cultivosData);
            cultivosNombre = cultivosData;

        } catch (error) {
            console.error("Error obteniendo los nombres de los cultivos:", error);
            alert("Hubo un problema al cargar los datos.");
            return;
        }

        let html = `
            <table class="table" border="1" id="tabla_parcelas">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cultivo</th>
                        <th>Tamaño</th>
                    </tr>
                </thead>
                <tbody>
        `;

        data.forEach(parcela => {
            html += `
                <tr>
                    <td>${parcela.nombre}</td>
                    <td>${cultivosNombre.nombre || "Desconocido"}</td>
                    <td>${parcela.tamanyo}</td>
                </tr>
            `;
        });

        html += `</tbody></table>`;

        contentDiv.innerHTML = html;
    }


    function actualizarURL(id) {
        const newURL = `/explotaciones/parcelas?explotacion=${id}`;
        history.pushState({ id: id }, "", newURL);
    }

    window.onpopstate = function(event) {
        if (event.state && event.state.id) {
            cargarDatos(event.state.id);
        }
    };
</script>

<div id="content-parcelas" class="ps-5">

    <div id="tabla" class="d-flex w-25 pe-4">



    </div>


</div>

@endsection
