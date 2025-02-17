<div class="col-10">
    <div class="d-flex justify-content-end me-2">
        <select class="d-flex form-select form-control expoSelect" id="expoSelect" onchange="guardarSeleccion()">
            <option selected disabled>Selecciona una opción</option>
            @foreach ($explotacion as $explo)
                <option value="{{ $explo->id }}">{{ $explo->nombre }}</option>
            @endforeach
        </select>
    </div>
    @yield('content2')

</div>
