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


<div id="seccion" hidden>

    <div class="d-flex flex-row mt-3 ms-3 align-items-center" >
        <input type="search" class="form-control ms-3 w-25" placeholder="Buscar" aria-label="Buscar">
        <div class="pe-4">
        <button type="button" class="btn button-primary p-4 ms-5" data-bs-toggle="modal" data-bs-target="#anadirMaquina">
            Añadir máquina
        </button>
        </div>
    </div>

    <div id="listado">

    </div>

    <div class="modal" id="anadirMaquina" tabindex="-1" aria-labelledby="anadirUsuarioModal" aria-hidden="true">

        <div class="modal-dialog m1">

            <div class="modal-content m2">

                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Nueva máquina</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('maquinas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pb-5">
                            <h2 class="mb-3">1. Datos  </h2>
                            <div class="row">
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

                        <div class="pb-5">
                            <div class="row">
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
                                    <input type="file" class="form-control fotoinput" accept="image/png, image/jpeg" id="imagenMaquina" name="imagenMaquina">
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
