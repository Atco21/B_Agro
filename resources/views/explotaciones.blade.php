@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 75vh;">
  <div class="text-center">
    <h2 class="mb-3">No hay explotaciones</h2>
    <div class="text-center mt-4">
      <button type="button" class="btn button-primary p-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Crear Explotacion
      </button>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content d-flex justify-content-center">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Nueva explotación</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-5">

        <!-- Contenido del formulario para crear explotación -->
        <form>
          <div class="row mb-3">
            <div class="col">
              <label for="nombreExplotacion" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombreExplotacion" placeholder="Nombre">
            </div>
            <div class="col">
              <label for="ubicacionExplotacion" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="ubicacionExplotacion" placeholder="Dirección">
            </div>
            <div class="col">
              <label for="localidadExplotacion" class="form-label">Localidad:</label>
              <input type="text" class="form-control" id="localidadExplotacion" placeholder="Localidad">
            </div>
            <div class="col">
              <label for="tamanyoExplotacion" class="form-label">Tamaño:</label>
              <input type="text" class="form-control" id="tamanyoExplotacion" placeholder="Tamaño">
            </div>
          </div>
        </form>

      </div>

      <div class="d-flex justify-content-end">

      <button type="button" class="btn button-secondary">Crear explotación</button>
      </div>

    </div>
  </div>
</div>
@endsection