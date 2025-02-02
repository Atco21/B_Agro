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

        fetch(`/api/explotaciones/datos/${id}`)
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

    function actualizarContenido(data) {
        const contentDiv = document.getElementById("content-parcelas");
        if (!contentDiv) return;

        let html = `<h2>Parcelas</h2>`;
        if (data.parcelas.length > 0) {
            data.parcelas.forEach(parcela => {
                html += `
                    <div>
                        <strong>ID:</strong> ${parcela.id} <br>
                        <strong>Nombre:</strong> ${parcela.nombre} <br>
                        <strong>Cultivo:</strong> ${parcela.cultivo ? parcela.cultivo.nombre : "Sin Cultivo"} <br>
                    </div><hr>
                `;
            });
        } else {
            html += `<div>No hay parcelas disponibles.</div>`;
        }

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

<div id="content-parcelas">
    <h2>Parcelas</h2>
    @forelse ($parcelas as $parcela)
        <div>
            <strong>ID:</strong> {{$parcela->id}} <br>
            <strong>Nombre:</strong> {{$parcela->nombre}} <br>
            <strong>Cultivo:</strong> {{ $parcela->cultivo->nombre ?? 'Sin Cultivo' }} <br>
        </div>
        <hr>
    @empty
        <div>No hay parcelas disponibles.</div>
    @endforelse
</div>

@endsection
