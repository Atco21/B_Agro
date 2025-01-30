@extends('explotacion')

@section('content2')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Superficie</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parcelas as $parcela)
                <tr>
                    <td>{{ $parcela->id }}</td>
                    <td>{{ $parcela->nombre }}</td>
                    <td>{{ $parcela->superficie }} ha</td>
                    <td>
                        <a href="#" class="btn btn-info">Ver Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
