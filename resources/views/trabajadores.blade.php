@extends('layouts.app')

@section('content')
    <script>
        addEventListener('DOMContentLoaded', inicio);

        function inicio() {
            const select = document.querySelector(".exploSelect");
            const searchInput = document.getElementById("searchInput");
            const contentDiv = document.getElementById("usuarios");

            select.selectedIndex = 0;

            if (select) {
                select.addEventListener("change", function() {
                    const id = select.value;
                    searchInput.value = "";

                    if (id) {
                        cargarDatos(id);
                    }
                });
            }

            searchInput.addEventListener("input", function() {
                const busqValue = searchInput.value.toLowerCase();
                const users = document.querySelectorAll(".cuadroPersona");

                users.forEach(user => {
                    const usuario = user.querySelector(".card-title").innerText.toLowerCase();
                    if (usuario.includes(busqValue)) {
                        user.style.display = "block";
                    } else {
                        user.style.display = "none";
                    }
                });
            });

            contentDiv.addEventListener("click", function(e) {
                const cuadro = e.target.closest(".cuadroPersona");
                if (!cuadro) return;

                fetch(`http://127.0.0.1:8000/api/trabajadores/buscar/${cuadro.id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.length === 0) return;

                        const user = data[0];

                        document.getElementById("edit_user_id").value = user.id;
                        document.getElementById("edit_nombre").value = user.nombre;
                        document.getElementById("edit_dni").value = user.dni;
                        document.getElementById("edit_explotacion_id").value = user.explotacion_id;
                        document.getElementById("edit_rol").value = user.rol;
                        document.getElementById("edit_email").value = user.email;
                        document.getElementById("edit_fecha_nacimiento").value = user.fecha_nacimiento;
                        document.getElementById("edit_telefono").value = user.telefono;
                        document.getElementById("edit_usuario").value = user.usuario;
                        document.getElementById("password").value = user.password;
                        document.getElementById("deleteForm").action = `/trabajadores/${user.id}`;

                        const modal = new bootstrap.Modal(document.getElementById("editarUsuario"));
                        modal.show();
                    })
                    .catch(error => console.error("Error al buscar el usuario:", error));
            });
        }

        function cargarDatos(id) {
            let html = "";
            let contentDiv = document.getElementById('usuarios');

            fetch(`http://127.0.0.1:8000/api/trabajadores/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!data || data.length === 0) {
                        html = `
                    <div class="alert alert-danger p-5 ms-5" role="alert">
                        No se han encontrado resultados.
                    </div>
                `;
                        contentDiv.innerHTML = html;
                    } else {
                        data.forEach(user => {
                            html += `
                        <div class="card mt-3 ms-3 ms-4 cuadroPersona" id="${user.id}" style="width: 25em; height: 20em; cursor: pointer;">
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
            <button type="button" class="btn button-primary p-4 ms-5" data-bs-toggle="modal"
                data-bs-target="#anadirUsuario">
                Añadir usuario
            </button>
        </div>
    </div>



    @if ($users->count() > 0)
        <div class=" d-flex flex-wrap vw-100 mt-4  overflow-auto vh-75" id="usuarios">

            @foreach ($users as $user)
                <div class="card mb-2 pt-3 ms-4 cuadroPersona" style="width: 25em; height: 20em;" id="{{ $user->id }}">
                    <div class="d-flex flex-row  ms-3 align-items-center">
                        <img src="{{ asset('./assets/logoAgro.png') }}" alt="Foto de perfil" class="fotoPerfil"
                            width="150px">
                        <h4 class="card-title ps-5">{{ $user->nombre }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Explotación: <b>{{ $user->explotacion->nombre }}</b></h5>
                        <h5 class="card-title">Rol: <b>{{ $user->rol }}</b></h5>
                        <h5 class="card-title">Estado: <b></b></h5>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="modal" id="editarUsuario" tabindex="-1" aria-labelledby="editarUsuarioModal" aria-hidden="true">
            <div class="modal-dialog m1">
                <div class="modal-content m2">
                    <div class="modal-header">
                        <h2 class="modal-title">Editar usuario</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('trabajadores.update') }}" method="POST" id="id">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_user_id" name="user_id">

                            <div class="pb-5">
                                <h2 class="mb-3">1. Datos personales</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label">Nombre completo:</label>
                                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dni" class="form-label">DNI:</label>
                                        <input type="text" class="form-control" id="edit_dni" name="dni"
                                            placeholder="Introduce DNI" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="edit_email" name="email"
                                            placeholder="Introduce email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de
                                                    nacimiento:</label>
                                                <input type="date" class="form-control" id="edit_fecha_nacimiento"
                                                    name="fecha_nacimiento" required>
                                            </div>
                                            <div class="col">
                                                <label for="telefono" class="form-label">Número de teléfono:</label>
                                                <input type="text" class="form-control" id="edit_telefono"
                                                    name="telefono" placeholder="Introduce teléfono" required>
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
                                        <select class="form-select form-control" id="edit_rol" name="rol" required>
                                            <option selected disabled>Selecciona una opción</option>
                                            <option value="jefe de campo">Jefe de campo</option>
                                            <option value="aplicador">Aplicador</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="explotacion_id" class="form-label">Explotación:</label>
                                        <select class="form-select form-control" id="edit_explotacion_id"
                                            name="explotacion_id" required>
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
                                        <input type="text" class="form-control" id="edit_usuario" name="usuario"
                                            placeholder="Introduce usuario" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Contraseña:</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Introduce contraseña" required>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">

                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                        </form>
                        <form id="deleteForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex me-auto">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        </div>
    @else
        <h2>No existen usuarios</h2>
    @endif



    <div class="modal fade" id="anadirUsuario" tabindex="-1" aria-labelledby="anadirUsuarioModal" aria-hidden="true">
        <div class="modal-dialog m1">
            <div class="modal-content m2">
                <div class="modal-header">
                    <h2 class="modal-title" id="anadirUsuarioModal">Nuevo usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="pb-5">
                            <h2 class="mb-3">1. Datos personales</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Nombre completo:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Introduce nombre completo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni"
                                        placeholder="Introduce DNI" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Introduce email" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col">
                                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento"
                                                name="fecha_nacimiento" required>
                                        </div>
                                        <div class="col">
                                            <label for="telefono" class="form-label">Número de teléfono:</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono"
                                                placeholder="Introduce teléfono" required>
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
                                    <select class="form-select form-control" id="explotacion_id" name="explotacion_id"
                                        required>
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
                                    <input type="text" class="form-control" id="usuario" name="usuario"
                                        placeholder="Introduce usuario" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Introduce contraseña" required>
                                </div>
                            </div>
                        </div>

                        {{-- Modal footer con botones de Enviar y Cancelar --}}
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Guardar usuario</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
