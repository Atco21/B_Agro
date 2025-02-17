@extends('explotacion')

@section('content2')



<script>

function inicio() {
    const select = document.querySelector(".expoSelect");

    if (select) {
        select.addEventListener("change", function() {
            const id = select.value;
            if (id) {
                cargarDatos(id);      // Carga parcelas
                cargarAlmacen(id);    // Carga almacén y productos químicos
                actualizarURL(id);
            }
        });
    }
}


async function cargarAlmacen(id) {
    fetch(`/api/almacen/explotacion/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("No se encontraron datos de almacenes");
            } else {
                document.getElementById('almacen').removeAttribute('hidden');
                actualizarContenidoAlmacen(data);
            }
        })
        .catch(error => console.error("Error en la petición:", error));
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

    almacenes.forEach(almacen => {
        almacen.quimicos.forEach(quimico => {
            html += `
                <tr>
                    <td>${almacen.nombre}</td>
                    <td>${quimico.nombre}</td>
                    <td>${quimico.cantidad}</td>
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


<div id="quimicos" hidden>
    <h3>Productos Químicos en el Almacén</h3>
</div>



@endsection
