@extends('explotacion')

@section('content2')
<div>
    <h2>General</h2>
    @forelse ($explotacion as $item)
        <div>
            {{$item->nombre}}
        </div>
    @empty
        <div>No hay explotaciones disponibles.</div>
    @endforelse
</div>
@endsection
