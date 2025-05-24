@extends('explotacion')

@section('content2')
<script>

addEventListener('DOMContentLoaded', inicio);


function inicio(){
    document.getElementById('exploOpciones').removeAttribute('hidden');
}
</script>


<div class="ms-5" id="previoAlmacen" hidden>
    <div class="d-flex flex-row">
        <div class="ms-auto pe-3">
            <button href="" class="btn btn-primary mb-2 me-4 "><h4>Agregar almacén</h4></button>
        </div>

    </div>

    <div class="d-flex align-items-center oveflow-auto flex-wrap">

        @foreach ($almacenes as $almacen)
        <div class="almacen-tarjeta m-2 flex-column w-25 " >
            <h3 class="mt-4 mb-2 text-center text-truncate">{{ $almacen->nombre }} - {{$almacen->explotacion->nombre}}</h3>
            <div class="d-flex flex-column align-items-center">
                <div class="resumen-tarjeta mt-2 w-100">
                    <h4>Stock por reponer ->  <b><i>25</i></b></h4>
                </div>
                <div class="resumen-tarjeta mt-5 w-100 ">
                    <h4>Químicos en peligro ->  <b><i>25</i></b></h4>
                    <div class="quimicos-peligro mt-5" style="overflow-y: auto; font-size: 1.2em">
                        <ul>
                            <li>ID: <b class="me-3">1</b>    Nombre: <b class="ms-1">Fertilizante</b></li>
                            <li>ID: <b class="me-3">1</b>    Nombre: <b class="ms-1">Fertilizante</b></li>
                            <li>ID: <b class="me-3">1</b>    Nombre: <b class="ms-1">Fertilizante</b></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>


<div class="ms-5" id="almacenOpciones">

    <div></div>
        <div class="d-flex flex-row mb-3">
            <div class="me-auto pe-3">
                <button href="" class="btn botonAlmacen"><h4>Añadir stock</h4></button>
                <button href="" class="btn botonAlmacen"><h4>Agregar químico</h4></button>
            </div>
        </div>

        <div class="d-flex align-items-center oveflow-auto flex-wrap">

            <table class="table text-center w-50">
                <thead>
                    <tr>
                        <th class="th_verde_primero">Nombre</th>
                        <th class="th_verde">Tipo</th>
                        <th class="th_verde">Cantidad</th>
                    </tr>
                </thead>
                <tbody id="tablaAlmacen">

                </tbody>
            </table>

        </div>




</div>


@endsection
