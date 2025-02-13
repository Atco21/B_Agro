@extends('explotacion')

@section('content2')


<script>

    document.addEventListener('DOMContentLoaded', function() {
        var elemento = document.getElementById('selectExplotacion');
        elemento.setAttribute('hidden', 'true');
    });

</script>

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
</div>


@endsection
