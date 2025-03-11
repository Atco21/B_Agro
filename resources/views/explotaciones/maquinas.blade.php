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
                filtrarMaquinasPorExplotacion(id);
            }
        });
    }

    document.getElementById("searchInput").addEventListener("input", function () {
        const busqValue = this.value.toLowerCase();
        const maquinas = document.querySelectorAll(".cuadroMaquina");

        maquinas.forEach(maquina => {
            const nombre = maquina.querySelector(".card-title").innerText.toLowerCase();
            if (nombre.includes(busqValue)) {
                maquina.style.display = "block";
            } else {
                maquina.style.display = "none";
            }
        });
    });
}

function filtrarMaquinasPorExplotacion(id) {
    const maquinas = document.querySelectorAll('.cuadroMaquina'); // o ajusta este selector según tu HTML

    maquinas.forEach(maquina => {
        const explotacionId = maquina.getAttribute("data-explotacion");

        // Mostrar solo las máquinas que coinciden con la explotación seleccionada
        if (explotacionId === id) {
            maquina.style.display = 'block'; // Mostrar la máquina
        } else {
            maquina.style.display = 'none'; // Ocultar la máquina
        }
    });
}

async function cargarMaquina(id) {
    try {
        const response = await fetch(`http://0.0.0.0/api/maquinas/explotacion/${id}`);
        const data = await response.json();
        if (data.error) {
            alert("No hay datos");
        } else {
            document.getElementById('seccion').removeAttribute('hidden');
            actualizarContenido(data);
        }
    } catch (error) {
        console.error("Error en la petición:", error);
    }
}

async function actualizarContenido(data) {
    let contentDiv = document.getElementById('listado');
    document.getElementById('previo').setAttribute('hidden', '');
    let html = '';

    data.forEach(maquina => {
        html += `
            <div class="card mt-3 ms-3 ms-4" style="width: 25rem;" >
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

    contentDiv.innerHTML = html;
}

document.addEventListener("DOMContentLoaded", function () {
    const cuadros = document.querySelectorAll(".cuadroMaquina");

    cuadros.forEach(cuadro => {
        cuadro.addEventListener("click", async function () {
            try {
                const response = await fetch(`http://0.0.0.0/api/maquinas/buscar/${cuadro.id}`);
                const data = await response.json();

                if (!data) {
                    alert("No hay datos");
                    return;
                }

                console.log(data);

                // Asignar valores a los inputs del modal
                document.getElementById("edit_nombre_maquina").value = data.nombre || "";
                document.getElementById("edit_matricula").value = data.matricula || "";
                document.getElementById("edit_explotacion_id").value = data.explotacion_id;
                document.getElementById("edit_maquina_id").value = data.id ;

                // Mostrar el modal
                let modal = new bootstrap.Modal(document.getElementById("editarMaquina"));
                modal.show();

            } catch (error) {
                console.error("Error en la petición:", error);
                alert("Hubo un error al cargar los datos.");
            }
        });
    });
});
</script>

<div class="modal" id="editarMaquina" tabindex="-1" aria-labelledby="editarMaquinaModal" aria-hidden="true">
    <div class="modal-dialog m11">
        <div class="modal-content m2">
            <div class="modal-header">
                <h2 class="modal-title">Editar Máquina</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('maquinas.update') }}" method="POST" id="editMaquinaForm">
                    @csrf
                    @method('PUT')

                    <!-- Campo oculto para el ID de la máquina -->
                    <input type="hidden" id="edit_maquina_id" name="maquina_id">

                    <h2 class="mb-3">1. Datos</h2>
                    <div class="pb-5 d-flex flex-row">
                        <div class="row w-100">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="edit_nombre_maquina" name="nombre" required>
                            </div>
                            <div class="col-md-6">
                                <label for="matricula" class="form-label">Matricula:</label>
                                <input type="text" class="form-control" id="edit_matricula" name="matricula" required>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 d-flex flex-row">
                        <div class="row w-100">
                            <div class="col-md-6">
                                <label for="explotacion_id" class="form-label">Explotación:</label>
                                <select class="form-select form-control" id="edit_explotacion_id" name="explotacion_id" required>
                                    <option selected disabled>Selecciona una opción</option>
                                    @foreach ($explotacion as $explo)
                                        <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="imagen" class="form-label">Foto máquina:</label>
                                <input type="file" class="form-control" accept="image/png, image/jpeg" id="edit_imagen" name="imagenMaquina">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="ps-3 " id="seccion" >

    <div class="d-flex flex-row mt-3 align-items-center" >
        <input type="search" class="form-control ms-3 w-25" id="searchInput" placeholder="Buscar" aria-label="Buscar">
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

    <div id="listado" class="overflow-hidden">

        <div class="row mb-5 pb-5">

            @foreach ($maquinas as $maquina)
            <div class="card mt-3 ms-3 ms-4 cuadroMaquina" style="width: 25rem;" id="{{$maquina->id}}" data-explotacion="{{$maquina->explotacion_id}}">
                <div class="d-flex flex-row mt-3 ms-3 align-items-center">
                    <img src="{{asset('./assets/logoAgro.png')}}" alt="Foto máquina" class="fotoPerfil" width="150px">
                    <h4 class="card-title ps-5">{{$maquina->nombre}}</h4>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Capacidad: <b>{{$maquina->capacidad}}</b></h5>
                    <h5 class="card-title">Matricula: <b>{{$maquina->matricula}}</b></h5>
                    <h5 class="card-title">Explot: <b>{{$maquina->explotacion->nombre}}</b></h5>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div class="modal" id="anadirMaquina" tabindex="-1" class=" d-flex justify-content-center align-items-center" aria-labelledby="anadirUsuarioModal" aria-hidden="true">

        <div class="modal-dialog m11">

            <div class="modal-content m2">

                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Nueva máquina</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('maquinas.store') }}" method="POST">
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
                                    <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Introduce matrícula de la máquina" required>
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
                                    <input type="file" class="form-control" accept="image/png, image/jpeg" id="imagen" name="imagenMaquina">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
