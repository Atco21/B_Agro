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
                cargarMaquina(id);
                actualizarURL(id);
            }
        });
    }
}


async function cargarMaquina(id){

    fetch(`http://localhost/api/maquinas/explotacion/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("No hay datos");
            } else {
                document.getElementById('seccion').removeAttribute('hidden');
                actualizarContenido(data);
            }
        })
        .catch(error => console.error("Error en la petición:", error));
}


async function actualizarContenido(data){
    let contentDiv  = document.getElementById('listado');
    document.getElementById('previo').setAttribute('hidden', '');
    let html = '';
    try{


    data.forEach(maquina => {

        html +=`
        <div class="card mt-3 ms-3 ms-4" style="width: 25rem;">
            <div class="d-flex flex-row mt-3 ms-3 align-items-center">
                <img src="{{asset('./assets/logoAgro.png')}}" alt="Foto máquina" class="fotoPerfil" width="150px">
                <h4 class="card-title ps-5">${maquina.nombre}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Capacidad: <b>${maquina.capacidad || 'sin capacidad'}</b></h5>
                <h5 class="card-title">Matricula: <b>${maquina.matricula || 'sin matrícula'}</b></h5>
            </div>
        </div>
        `;


    });
    }catch (error) {
        console.error("Error obteniendo los nombres de los cultivos:", error);
        alert("Hubo un problema al cargar los datos.");
    }
    contentDiv.innerHTML = html;




}


function actualizarURL(id_explo) {
    const newURL = `/explotaciones/maquinas/${id_explo}`;
    history.pushState({ id: id_explo }, "", newURL);
}
window.onpopstate = function(event) {
    if (event.state && event.state.id) {
        cargarMaquina(event.state.id);
    }
};
</script>

<div id="previo">

    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">

    <h2>Selecciona una explotación</h2>

    </div>

</div>


<div class="ps-3" id="seccion" hidden>

    <div class="d-flex flex-row mt-3 align-items-center" >
        <input type="search" class="form-control ms-3 w-25" placeholder="Buscar" aria-label="Buscar">
        <div class="pe-2">
        <button type="button" class="btn ms-3" data-bs-toggle="modal" data-bs-target="#anadirMaquina">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1172_4174)">
                <path d="M16 28C22.6274 28 28 22.6274 28 16C28 9.37258 22.6274 4 16 4C9.37258 4 4 9.37258 4 16C4 22.6274 9.37258 28 16 28Z" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11 16H21" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 11V21" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </g>
                <defs>
                <clipPath id="clip0_1172_4174">
                <rect width="32" height="32" fill="#01533E"/>
                </clipPath>
                </defs>
              </svg>
        </button>
        </div>
    </div>

    <div id="listado" class="">

    </div>

    <div class="modal" id="anadirMaquina" tabindex="-1" class=" d-flex justify-content-center align-items-center" aria-labelledby="anadirUsuarioModal" aria-hidden="true">

        <div class="modal-dialog m11">

            <div class="modal-content m2">

                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Nueva máquina</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('maquinas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="mb-3">1. Datos  </h2>
                        <div class="pb-5 d-flex flex-row">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce nombre de la máquina" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="matricula" class="form-label">Matricula:</label>
                                    <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Introduce matricula" required>
                                </div>
                            </div>
                        </div>

                        <div class="pb-5 d-flex flex-row">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <label for="explotacion_id" class="form-label">Explotación:</label>
                                    <select class="form-select form-control" id="explotacion_id" name="explotacion_id" required>
                                        <option selected disabled>Selecciona una opción</option>
                                        @foreach ($explotacion as $explo)
                                            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="imagen" class="form-label">Foto máquina:</label>
                                    <input type="file" class="form-control" accept="image/png, image/jpeg" id="imagenMaquina" name="imagenMaquina">
                                </div>
                            </div>
                        </div>


                        <div class="pb-5">

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn button-secondary1">Añadir máquina</button>
                        </div>
                </form>
        </div>
    </div>

</div>



@endsection
