@extends('layouts.app')

@section('content')





@if ($explotacion->count() > 0)
<div class="d-flex flex-row mt-0">


    <!-- Columna para los <h3> -->


    <div class="col-2 vh-100 d-flex flex-column justify-content-between">
        <div class="d-flex flex-column justify-content-around h-50 ps-2">
            <a class="menu2 {{ Request::is('general') ? 'active' : '' }}" href="{{ url('explotaciones/general') }}">General</a>
            <a class="menu2 {{ Request::is('parcelas') ? 'active' : '' }} " href="{{ url('explotaciones/parcelas') }}">Parcelas</a>
            <a class="menu2 {{ Request::is('tareas') ? 'active' : '' }} " href="{{ url('explotaciones/tareas') }}">Tareas</a>
            <a class="menu2 {{ Request::is('incidencias') ? 'active' : '' }} " href="{{ url('explotaciones/incidencias') }}">Incidencias</a>
            <a class="menu2 {{ Request::is('maquinas') ? 'active' : '' }} " href="{{ url('explotaciones/maquinas') }}">Máquinas</a>
            <a class="menu2 {{ Request::is('pedidos') ? 'active' : '' }} " href="{{ url('explotaciones/pedidos') }}">Pedidos</a>

        </div>
    </div>


    <!-- Columna para el resto del contenido -->
    <div class="col-10">
        <div class="d-flex justify-content-end me-2">
            <select class="d-flex form-select form-control expoSelect mt-3" id="selectExplotacion">
                <option selected disabled>Selecciona una opción</option>
                @foreach ($explotacion as $explo)
                    <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                @endforeach
            </select>
        </div>
        @yield('content2')
    </div>



</div>

@else

<div class="d-flex align-items-center justify-content-center" style="height: 75vh;">
    <div class="text-center">
      <h2 class="mb-3">No hay explotaciones</h2>
      <div class="text-center mt-4">
        <button type="button" class="btn button-primary p-3" data-bs-toggle="modal" data-bs-target="#crearexplotacion">
          Crear Explotacion
        </button>
      </div>
    </div>
  </div>


<div class="modal fade" id="crearexplotacion" tabindex="-1" aria-labelledby="crearexplotacionLabel" aria-hidden="true">
  <div class="modal-dialog m1">
    <div class="modal-content d-flex justify-content-center m2">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Nueva explotación</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-5">

        <form>
          <div class="campos row mb-3">
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
          <div class=" parcelas row mb-3 justify-content-center align-items-center">
            <div class="col text-center">
              <h3 class="text-light">Parcelas</h3>
            </div>
            <div class="col-auto text-center">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#crearparcela">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_1172_4174)">
                  <path d="M16 28C22.6274 28 28 22.6274 28 16C28 9.37258 22.6274 4 16 4C9.37258 4 4 9.37258 4 16C4 22.6274 9.37258 28 16 28Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M11 16H21" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M16 11V21" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_1172_4174">
                  <rect width="32" height="32" fill="white"/>
                  </clipPath>
                  </defs>
                </svg>
              </button>
            </div>

          </div>

        </form>

      </div>

      <div class="modal-footer d-flex justify-content-end">

      <button type="button" class="btn button-secondary">Crear explotación</button>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="crearparcela" tabindex="-1" aria-labelledby="crearParcelaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content d-flex justify-content-center">
      <div class="modal-header">

        <h3>Crear parcela</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="d-flex align-items-center justify-content-center" style="height: 75vh;">
            <div class="text-center">
              <h2 class="mb-3">No hay explotaciones</h2>
              <div class="text-center mt-4">
                <button type="button" class="btn button-primary p-3" data-bs-toggle="modal" data-bs-target="#crearexplotacion">
                  Crear Explotacion
                </button>
              </div>
            </div>
          </div>


        <div class="modal fade" id="crearexplotacion" tabindex="-1" aria-labelledby="crearexplotacionLabel" aria-hidden="true">
          <div class="modal-dialog m1">
            <div class="modal-content d-flex justify-content-center m2">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Nueva explotación</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
      </div>
      <div class="modal-body">
          <form>
            <div class="row mb-3 mx-2">
              <label for="nombreParcela" class="form-label">Nombre:</label>
              <input type="text" class="form-control" id="nombreParcela" placeholder="Nombre">
            </div>
            <div class="row mb-3 mx-2">
              <label for="cultivoParcela" class="form-label">Cultivo:</label>
              <select class="form-select form-control" id="cultivoParcela">
                <option selected>Elige una opción</option>
                <option value="patatas">Patatas</option>
                <option value="tomates">Tomates</option>
              </select>
            </div>
            <div class="row mb-3 mx-2">
              <label for="tamanyoParcela" class="form-label">Tamaño: (ha)</label>
              <input type="number" class="form-control" id="tamanyoParcela" placeholder="1" min="1">
            </div>
          </form>
      </div>
      <div class="modal-footer modal-dialog-centered d-flex justify-content-center">
        <button type="button" class="btn button-secondary1">Crear parcela</button>
      </div>
    </div>
  </div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#crearparcela').on('show.bs.modal', function () {
            $('#crearexplotacion').modal('hide');
        });

        $('#crearparcela').on('hidden.bs.modal', function () {
            $('#crearexplotacion').modal('show');
        });
    });
</script>


@endif




@endsection



