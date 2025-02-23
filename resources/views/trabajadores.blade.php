@extends('layouts.app')

@section('content')
<script>
addEventListener('DOMContentLoaded', inicio);

function inicio() {
    const select = document.querySelector(".exploSelect");
    const searchInput = document.getElementById("searchInput");

    select.selectedIndex = 0;

    if (select) {
        select.addEventListener("change", function() {
            const id = select.value;
            searchInput.value=""

            if (id) {
                cargarDatos(id);
            }
        });
    }



    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.toLowerCase();
        const users = document.querySelectorAll(".cuadroPersona");

        users.forEach(user => {
            const userName = user.querySelector(".card-title").innerText.toLowerCase();
            if (userName.includes(searchValue)) {
                user.style.display = "block";
            } else {
                user.style.display = "none";
            }
        });
    });
}

function cargarDatos(id){
    let html = "";
    let contentDiv = document.getElementById('usuarios');


    fetch(`http://0.0.0.0/api/trabajadores/${id}`)
    .then(response => response.json())
        .then(data => {
            if (!data || data.length === 0) {
                alert("No hay datos");
                contentDiv.innerHTML = html;


            } else {
                data.forEach(user => {


                    html += `
                        <div class="card mt-3 ms-3 ms-4 cuadroPersona" style="width: 25em; height: 20em;">
                            <div class="d-flex flex-row mt-3 ms-3 align-items-center">
                                <img src="{{ asset('./assets/logoAgro.png') }}" alt="Foto de perfil" class="fotoPerfil" width="150px">
                                <h4 class="card-title ps-5">${user.nombre}</h4>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Explotación: <b>${user.explotacion.nombre}</b></h5>
                                <h5 class="card-title">Rol: <b>${user.rol}</b></h5>
                                <h5 class="card-title">Estado: <b></b></h5>
                            </div>
                        </div>
                    `;
                });
                contentDiv.innerHTML = html;

            }

        })
        .catch(error => console.error("Error en la petición:", error));
}






</script>


<div class="d-flex flex-row mt-3 ms-3 align-items-center">
    <input type="search" id="searchInput" class="form-control ms-3 w-25" placeholder="Buscar" aria-label="Buscar">

    <select class="form-select form-control exploSelect ms-3 w-auto">
        <option selected disabled>Selecciona una opción</option>
        @foreach ($explotacion as $explo)
            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
        @endforeach
    </select>
    <div class="ms-auto pe-4">
    <button type="button" class="btn button-primary p-4 ms-5" data-bs-toggle="modal" data-bs-target="#anadirUsuario">
        Añadir usuario
      </button>
    </div>
</div>



    @if(($users->count())>0)



    <div class=" d-flex flex-wrap vw-100 m-3 overflow-auto vh-100 pb-5" id="usuarios">

        @foreach ($users as $user)


        <div class="card mt-3 ms-3 ms-4 cuadroPersona" style="width: 25em; height: 20em;" >
            <div class="d-flex flex-row mt-3 ms-3 align-items-center">
                <img src="{{asset('./assets/logoAgro.png')}}" alt="Foto de perfil" class="fotoPerfil" width="150px">
                <h4 class="card-title ps-5">{{$user->nombre}}</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Explotación: <b>{{$user->explotacion->nombre}}</b></h5>
                <h5 class="card-title">Rol: <b>{{ $user->rol }}</b></h5>
                <h5 class="card-title">Estado: <b></b></h5>
            </div>
        </div>




        @endforeach

    </div>

    @else


    <h2>No existen usuarios</h2>


    @endif



    <div class="modal" id="anadirUsuario" tabindex="-1" aria-labelledby="anadirUsuarioModal" aria-hidden="true">

        <div class="modal-dialog m1">

            <div class="modal-content m2">

                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Nuevo usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pb-5">
                            <h2 class="mb-3">1. Datos personales</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre completo:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce nombre completo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="Introduce DNI" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Introduce email" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col">
                                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                        </div>
                                        <div class="col">
                                            <label for="telefono" class="form-label">Número de teléfono:</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Introduce teléfono" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pb-5">
                            <h2 class="mb-3">2. Tipo de empleado</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="rol" class="form-label">Rol:</label>
                                    <select class="form-select form-control" id="rol" name="rol" required>
                                        <option selected disabled>Selecciona una opción</option>
                                        <option value="jefe de campo">Jefe de campo</option>
                                        <option value="aplicador">Aplicador</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="explotacion_id" class="form-label">Explotación:</label>
                                    <select class="form-select form-control" id="explotacion_id" name="explotacion_id" required>
                                        <option selected disabled>Selecciona una opción</option>
                                        @foreach ($explotacion as $explo)
                                            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pb-5">
                            <h2 class="mb-3">3. Registro</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="usuario" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduce usuario" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Introduce contraseña" required>
                                </div>
                            </div>
                            <div class="mtd
            </div>

        </div>

    </div>



</div>










@endsection
