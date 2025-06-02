@extends('layouts.app')

@section('content')
    <div class="d-flex flex-row vh-100 w-100 overflow-hidden">
        <div class="col-2 d-flex flex-column justify-content-start align-items-center pt-5" id="barra">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="menu2 nav-link {{ Request::is('*general*') ? 'active2' : '' }}"
                        href="{{ url('ventas/clientes') }}">Clientes</a>
                </li>

                <li class="nav-item">
                    <a class="menu2 nav-link {{ Request::is('*parcelas*') ? 'active2' : '' }}"
                        href="{{ url('ventas/facturas') }}">Facturas</a>
                </li>
            </ul>
        </div>


        <!-- Contenido principal -->
        <div class="col-11 d-flex flex-column h-100 pe-5">
            @yield('content3')
        </div>
    @endsection
