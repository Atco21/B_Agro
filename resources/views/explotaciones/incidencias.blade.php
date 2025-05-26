@extends('explotacion')

@section('content2')
  <div class="ms-5">
    <h3>Incidencias por Explotación</h3>

    <div class="row mt-2">
      @foreach($explotacion as $exp)
        @php
          $cnt = $incidencias[$exp->id] ?? ['personal'=>0,'stock'=>0,'maquina'=>0];
        @endphp

        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-header">
              {{ $exp->nombre }}
            </div>
            <div class="card-body">
              <p><strong>Personal:</strong> {{ $cnt['personal'] }}</p>
              <p><strong>Stock:</strong> {{ $cnt['stock'] }}</p>
              <p><strong>Máquina:</strong> {{ $cnt['maquina'] }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
