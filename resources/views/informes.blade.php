@extends('layouts.app')

@section('content')
    <div class="mt-4 w-100">
        <div class="row justify-content-center" style="height: 100% ;">
            <!-- Columna de formulario -->
            <div class="col-md-4">
                <h1 class="mb-4 text-center">Informes</h1>
                <p class="text-center mb-4">Genera un informe en formato PDF especificando el rango de fechas.</p>

                <form action="{{ route('ordenes.generar.pdf') }}" method="GET" class="bg-light p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Generar PDF</button>
                </form>
            </div>


        </div>
    </div>
@endsection
