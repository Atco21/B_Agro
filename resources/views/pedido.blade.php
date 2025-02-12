{{-- @extends('layouts.app')


@section('content') --}}


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Pedidos</title>
    <!-- Bootstrap CSS desde CDN -->

</head>
<body>
    {{-- <div class="container mt-5">
        <h1 class="text-center text-success mb-4">Lista de Pedidos</h1>

        <div class="row">
            @foreach ($pedidos as $pedido)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Pedido #{{ $pedido->id }}</h5>
                            <p class="card-text"><strong>Cliente:</strong> {{ $pedido->fecha_pedido
                             }}</p>
                            <p class="card-text"><strong>Fecha:</strong> {{ $pedido->estado }}</p>
                            <p class="card-text"><strong>Total:</strong> ${{ number_format($pedido->total, 2) }}</p>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lineaPedido{{$pedido->id}}">Ver Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="lineaPedido{{$pedido->id}}" tabindex="1" aria-labelledby="lineaPedidoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pedido #{{ $pedido->id }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                          </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> --}}

    {{-- <div class="container">
        <h2>Lista de Productos Químicos</h2>
        <form action="" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quimicos as $quimico)
                    <tr>
                        <td>{{ $quimico->nombre }}</td>
                        <td>{{ $quimico->tipo }}</td>
                        <td>
                            <input type="number" name="cantidad[{{ $quimico->id }}]" min="0" class="form-control">
                        </td>
                        <td>
                            <input type="checkbox" name="productos[]" value="{{ $quimico->id }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Realizar Pedido</button>
        </form>
    </div> --}}

    {{-- @foreach ($quimicos as $quimico){
        {{$quimico}}
    }

    @endforeach --}}

    {{$quimicos}}

</body>
</html>


{{-- @endsection --}}
