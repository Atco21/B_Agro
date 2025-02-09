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
    <button type="button" class="btn button-primary p-4 ms-3" data-bs-toggle="modal" data-bs-target="#crearexplotacion">
        Añadir usuario
      </button>
    </div>

</div>





@endsection
