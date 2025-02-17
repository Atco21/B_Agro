@extends('explotacion')

@section('content2')


<script>


</script>

<div class="d-flex flex-row mt-3 ms-3 align-items-center">
    <input type="search" class="form-control ms-3 w-25" placeholder="Buscar" aria-label="Buscar">
    <div class="pe-4">
    <button type="button" class="btn button-primary p-4 ms-5" data-bs-toggle="modal" data-bs-target="#anadirMaquina">
        Añadir máquina
      </button>
    </div>
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





@endsection
