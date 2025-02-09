@extends('layouts.app')

@section('content')
<div class="d-flex flex-row mt-3 ms-5">

    <input type="search" class="form-control ms-3 w-25 form-select" placeholder="Buscar" aria-label="Buscar">

    <select class="form-select form-control expoSelect ms-3">
        <option selected disabled>Selecciona una opción</option>
        @foreach ($explotacion as $explo)
            <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
        @endforeach
    </select>
    <div class="d-flex justify-content-end">
    <button type="button" class="btn button-primary p-4 ms-3" data-bs-toggle="modal" data-bs-target="#anadirUsuario">
        Añadir usuario
      </button>
    </div>



    <div class="modal" id="anadirUsuario" tabindex="-1" aria-labelledby="anadirUsuarioModal" aria-hidden="true">

        <div class="modal-dialog m1">

            <div class="modal-content ">

                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Nuevo usuario</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body d-flexs m2">

                    <form>
                        <div class="campos row mb3">
                            <div class="col">
                                <h2>1. Datos personales</h2>
                            </div>
                            <div class="col">
                                <h2>2. Tipo de empleado</h2>
                            </div>
                            <div class="col">
                                <h2>3. Registro</h2>
                            </div>
                        </div>

                        <div class="campos row mb3">
                            <div class="col">
                                <label for="nombreUsuario" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre">
                            </div>
                            <div class="col">
                                <label for="rol" class="form-label">Rol:</label>
                                <select class="form-select form-control" id="rol">
                                    <option selected disabled>Selecciona una opción</option>
                                    <option value="1">Jefe de campo</option>
                                    <option value="2">Aplicador</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="fotoUsuario" class="form-label">Foto usuario:</label>
                                <input type="file" class="form-control" accept="image/png, image/jpeg" />
                            </div>
                        </div>

                    </form>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn">Crear explotación</button>
                </div>

            </div>

        </div>

    </div>



</div>










@endsection
