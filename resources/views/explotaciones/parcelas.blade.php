@extends('explotacion')

@section('content2')

<div>
    <h2>Parcelas</h2>
    @forelse ($parcelas as $parcela)
        <div>
            {{$parcela->id}}
            {{$parcela->nombre}}
            {{ $parcela->cultivo->nombre ?? 'Sin Cultivo' }}


        </div>
    @empty
        <div>No hay parcelas disponibles.</div>
    @endforelse
</div>


@endsection
