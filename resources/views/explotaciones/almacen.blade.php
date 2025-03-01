@extends('explotacion')

@section('content2')



<script>
    addEventListener('DOMContentLoaded', inicio);

    function inicio() {
        const select = document.querySelector(".expoSelect");

        if (select) {
            select.addEventListener("change", function() {
                const id = select.value;
                if (id) {
                    cargarAlmacen(id);    // Carga almacén y productos químicos
                    actualizarURL(id);
                }
            });
        }
    }

    async function cargarAlmacen(id) {
    try {
        let response = await fetch(`/almacen/explotacion/${id}`);
        let data = await response.json();

        if (response.ok) {
            document.getElementById('almacen').removeAttribute('hidden');
            actualizarContenidoAlmacen(data);
        } else {
            alert(data.error);
        }
    } catch (error) {
        console.error("Error en la petición:", error);
        alert("Hubo un problema al cargar los datos.");
    }
}

async function actualizarContenidoAlmacen(data) {
    document.getElementById('previo').setAttribute('hidden', '');
    const contentDiv = document.getElementById("tabla_almacen");

    let html = `
        <table class="table" border="1" id="tabla_almacen_quimicos">
            <thead>
                <tr>
                    <th>Almacén</th>
                    <th>Producto Químico</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
    `;

    data.almacenes.forEach(almacen => {
        almacen.quimicos.forEach(quimico => {
            html += `
                <tr>
                    <td>${almacen.nombre}</td>
                    <td>${quimico.nombre}</td>
                    <td>${quimico.pivot.cantidad}</td>
                </tr>
            `;
        });
    });

    html += `</tbody></table>`;
    contentDiv.innerHTML = html;
}


    </script>

{{-- <div class="col-10">
    <div class="d-flex justify-content-end me-2">
    <select name="almacen" id=""  class="d-flex form-select form-control expoSelect mt-3">
        <option selected disabled>Almacen</option>
        @foreach ($almacenes as $almacen){
            <option value="{{$almacen->id}}">
                {{$almacen->nombre}}
            </option>
        }

        @endforeach
    </select>
</div>
</div> --}}

<div id="previo" >

    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">

    <h2>Selecciona una explotación</h2>

    </div>

</div>

<div id="almacen" hidden>
    <h2>Productos Químicos del Almacén</h2>
    <div id="tabla_almacen"></div>
</div>






@endsection
