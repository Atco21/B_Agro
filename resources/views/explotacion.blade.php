
@extends('layouts.app')

@section('content')

@if ($explotacion->count() > 0)

<div class="d-flex flex-row vh-100 w-100 overflow-hidden" >
    <!-- Menú lateral -->
    <div class="col-2 d-flex flex-column justify-content-start align-items-center pt-5" id="barra">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="menu2 nav-link {{ Request::is('*general*') ? 'active2' : '' }}" href="{{ url('explotaciones/general') }}">General</a>
            </li>
            <li class="nav-item">
                <a class="menu2 nav-link {{ Request::is('*parcelas*') ? 'active2' : '' }}" href="{{ url('explotaciones/parcelas') }}">Parcelas</a>
            </li>
            <li class="nav-item">
                <a class="menu2 nav-link {{  Request::is('*ordenes*') ? 'active2' : '' }} " href="{{ url('explotaciones/ordenes') }}">Órdenes</a>
            </li>

            <li class="nav-item">
                <a class="menu2 nav-link {{ Request::is('*maquinas*') ? 'active2' : '' }}" href="{{ url('explotaciones/maquinas') }}">Máquinas</a>
            </li>
            <li class="nav-item">
                <a class="menu2 nav-link {{ Request::is('*pedidos*') ? 'active2' : '' }}" href="{{ url('explotaciones/pedidos') }}" >Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="menu2 nav-link {{ Request::is('*incidencias*') ? 'active2' : '' }}" href="{{ url('explotaciones/incidencias') }}" style="border: none">Incidéncias</a>
            </li>
        </ul>
    </div>


    <!-- Contenido principal -->
    <div class="col-11 d-flex flex-column h-100 pe-5">
        <div class="d-flex justify-content-end align-items-center gap-3 p-3 pe-4">
            <button class="p-0" style="border: none; background:none; transform: scale(1.5);" title="Editar" data-bs-toggle="modal" data-bs-target="#editarExplotaciones">
                <svg width="30" height="30" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.8277 43.8753H9.75C9.31902 43.8753 8.9057 43.7041 8.60095 43.3993C8.29621 43.0946 8.125 42.6812 8.125 42.2503V33.1726C8.1252 32.7422 8.29614 32.3295 8.60031 32.025L33.6497 6.97557C33.9544 6.67106 34.3676 6.5 34.7984 6.5C35.2292 6.5 35.6423 6.67106 35.947 6.97557L45.0247 16.0471C45.3292 16.3519 45.5003 16.765 45.5003 17.1958C45.5003 17.6266 45.3292 18.0398 45.0247 18.3445L19.9753 43.4C19.6708 43.7041 19.2581 43.8751 18.8277 43.8753Z" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M27.625 13L39 24.375" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M33.3125 18.6875L15.4375 36.5625" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21.125 42.25L9.75 30.875" stroke="#01533E" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </button>

            <select class="form-select exploSelect">
                <option selected disabled>Selecciona una opción</option>
                @foreach ($explotacion as $explo)
                    <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
                @endforeach
            </select>
        </div>

        @yield('content2')
    </div>
</div>

<div class="modal fade mt-5" id="editarExplotaciones" tabindex="-1" aria-labelledby="editarExplotacionesModal" aria-hidden="true">


    <div class="modal-dialog m1">

        <div class="modal-content d-flex justify-content-center m2 ">

          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel">Explotaciones</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-5">

            <div>

                <table class="table" border="1" id="">
                    <tbody>
                        <tr>
                            <th class="th_verde_primero">Nombre</th>
                            <th class="th_verde">Tamaño</th>
                            <th class="th_verde"></th>
                        </tr>


                        @foreach ($explotacion as $explo)

                        <tr class="lineaParcela">

                            <td class="text-center">{{$explo->nombre}}</td>
                            <td class="text-center">{{$explo->tamanyo}}</td>
                            <td class="d-flex justify-content-center">
                                <button value="{{$explo->id}}" class="btn btn-ver" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#verExplotacionSeleccionada">Ver</button>
                                <button value="{{$explo->id}}" class="btn btn-editar ms-2" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#editarExplotacionSeleccionada">Editar</button>
                                <button value="{{$explo->id}}" class="btn btn-danger ms-2" style="width: 100px;">Eliminar</button>
                            </td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>

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





