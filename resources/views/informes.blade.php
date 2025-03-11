@extends('layouts.app')

@section('content')
    <h1>Informes</h1>
    <p>Contenido de Informes...</p>


    <form action="{{ route('ordenes.generar.pdf') }}" method="GET">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" required>

        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" required>


        <button type="submit">Generar PDF</button>
    </form>

@endsection
