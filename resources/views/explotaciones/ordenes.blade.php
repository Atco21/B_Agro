@extends('explotacion')

@section('content2')


<script>

addEventListener('DOMContentLoaded', inicio);

function inicio() {

>>>>>>> alfred
    const select = document.querySelector(".exploSelect");

    if (select) {
        select.addEventListener("change", function() {
            const id = select.value;
            console.log(id); // Verifica que este valor sea correcto
            if (id) {
                cargarDatos(id);
                //actualizarURL(id);
            }
        });
    }
}

async function cargarDatos(id) {
    alert('hola');
    fetch(`/api/ordenes/explotacion`)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Verifica si los datos están llegando aquí
            if (data.error) {
                alert("No hay datos");
            } else {
                document.getElementById('secciones').removeAttribute('hidden');
                document.getElementById('previo').setAttribute('hidden', '');
                //actualizarContenido(data);
            }
        })
        .catch(error => console.error("Error en la petición:", error));
}
</script>


<div id="previo" >

    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">

    <h2>Selecciona una explotación</h2>

    </div>

</div>

<div id="secciones" hidden>

<div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
    <table class="table table-bordered" style="width: 80%;"> <!-- Ajusta el tamaño de la tabla -->
        <thead>
            <tr>
                <th class="border border-dark text-center">En curso</th>
                <th class="border border-dark text-center">Pendientes</th>
                <th class="border border-dark text-center">Pausadas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" class="border border-dark">
                    <div class="input-group mb-3 mt-3 w-25" id="cuadroBusqueda">
                        <span class="input-group-text">
                            <!-- Icono de búsqueda -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path id="Vector" d="M19.3013 18.4803L14.6073 13.7872C15.9678 12.1538 16.6462 10.0588 16.5014 7.9379C16.3566 5.81703 15.3998 3.83363 13.8299 2.4003C12.26 0.966976 10.1979 0.194069 8.07263 0.242369C5.94738 0.290669 3.92256 1.15646 2.41939 2.65963C0.916222 4.1628 0.0504346 6.18762 0.0021347 8.31287C-0.0461652 10.4381 0.726742 12.5002 2.16007 14.0701C3.5934 15.64 5.5768 16.5969 7.69766 16.7417C9.81853 16.8865 11.9136 16.208 13.547 14.8475L18.2401 19.5416C18.3098 19.6113 18.3925 19.6665 18.4836 19.7043C18.5746 19.742 18.6722 19.7614 18.7707 19.7614C18.8693 19.7614 18.9669 19.742 19.0579 19.7043C19.1489 19.6665 19.2317 19.6113 19.3013 19.5416C19.371 19.4719 19.4263 19.3892 19.464 19.2981C19.5017 19.2071 19.5211 19.1095 19.5211 19.011C19.5211 18.9124 19.5017 18.8148 19.464 18.7238C19.4263 18.6327 19.371 18.55 19.3013 18.4803ZM1.52072 8.51096C1.52072 7.17593 1.9166 5.87089 2.6583 4.76086C3.4 3.65083 4.45421 2.78566 5.68761 2.27477C6.92101 1.76388 8.27821 1.63021 9.58758 1.89066C10.897 2.15111 12.0997 2.79398 13.0437 3.73799C13.9877 4.68199 14.6306 5.88473 14.891 7.1941C15.1515 8.50347 15.0178 9.86067 14.5069 11.0941C13.996 12.3275 13.1309 13.3817 12.0208 14.1234C10.9108 14.8651 9.60575 15.261 8.27072 15.261C6.48112 15.259 4.76538 14.5472 3.49994 13.2817C2.2345 12.0163 1.52271 10.3006 1.52072 8.51096Z" fill="#01533E"/>
                            </svg>
                        </span>
                        <input type="search" class="form-control" placeholder="Buscar" id="textoBusqueda">
                    </div>
                </td>
            </tr>

            <tr>
                <th class="border border-dark text-center">Nombre</th>
                <th class="border border-dark text-center">Asunto</th>
            </tr>

            <!-- Mostrar las órdenes -->
        </tbody>
    </table>
</div>
</div>
@endsection
