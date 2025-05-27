<nav class="navbar navbar-expand-lg">
    <div class="container-fluid w-100">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/explotaciones/general') }}">
            <img src="{{url('assets/logoAgro.png')}}" width="80" alt="Logo">
        </a>


        <!-- Contenido del Navbar -->
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarContent">
            <!-- Opciones principales a la izquierda -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('*explotaciones*') ? 'active' : '' }}" href="{{ url('/explotaciones/general') }}">Explotaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('trabajadores') ? 'active' : '' }}" href="{{ url('/trabajadores') }}">Trabajadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informes') ? 'active' : '' }}" href="{{ url('/informes') }}">Informes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('ventas') ? 'active' : '' }}" href="{{ url('/ventas') }}">Ventas</a>
                </li>
            </ul>

            <!-- Opciones de usuario a la derecha -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mi perfil <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu custom-dropdown" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Editar usuario</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><b>Cerrar sesión</b></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

