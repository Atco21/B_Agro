@extends('explotacion')

@section('content2')




<div class="col-10">
    <div class="d-flex justify-content-end me-2">
    <select name="almacen" id=""  class="d-flex form-select form-control expoSelect mt-3">
        <option selected disabled>Almacen</option>
        @foreach ($almacenes as $almacen){
            <option value="almacen{{$almacen->id}}">
                {{$almacen->nombre}}
            </option>
        }

        @endforeach
    </select>
</div>
</div>


@endsection
