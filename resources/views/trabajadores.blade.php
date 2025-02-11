@extends('layouts.app')

@section('content')
<div class="d-flex flex-row mt-3 ms-3 align-items-center">
    <input type="search" class="form-control ms-3 w-25" placeholder="Buscar" aria-label="Buscar">

    <select class="form-select form-control expoSelect ms-3 w-auto">
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



    <div class="modal" id="anadirUsuario" tabindex="-1" aria-labelledby="anadirUsuarioModal" aria-hidden="true">

        <div class="modal-dialog m1">

            <div class="modal-content m2">

                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Nuevo usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pb-5">
                            <h2 class="mb-3">1. Datos personales</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nombre_completo" class="form-label">Nombre completo:</label>
                                    <input type="text" class="form-control" id="nombre_completo" placeholder="Introduce nombre completo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dni" class="form-label">DNI:</label>
                                    <input type="text" class="form-control" id="dni" placeholder="Introduce DNI" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Introduce email">
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col">
                                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento">
                                        </div>
                                        <div class="col">
                                            <label for="telefono" class="form-label">Número de teléfono:</label>
                                            <input type="text" class="form-control" id="telefono" placeholder="Introduce teléfono">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">

                        </div>
                        <div class="pb-5">
                            <h2 class="mb-3">2. Tipo de empleado</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="rol" class="form-label">Rol:</label>
                                    <select class="form-select form-control" id="rol" required>
                                        <option selected disabled>Selecciona una opción</option>
                                        <option value="1">Jefe de campo</option>
                                        <option value="2">Aplicador</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="explotacion_id" class="form-label">Explotación:</label>
                                    <select class="form-select form-control" id="explotacion_id" required>
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
                                    <input type="text" class="form-control" id="usuario" placeholder="Introduce usuario" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" placeholder="Introduce contraseña" required>
                                </div>
                            </div>
                            <div class="mt-3 col-md-6">
                                <label for="imagen" class="form-label">Foto usuario:</label>
                                <input type="file" class="form-control fotoinput" accept="image/png, image/jpeg" id="imagen">
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>

                </div>



            </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn button-secondary1">Añadir usuario</button>
            </div>

        </div>

    </div>



</div>










@endsection
