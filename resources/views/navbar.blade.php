<nav class="navbar navbar-expand-lg">
    <div class="container-fluid w-100">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/explotaciones') }}">
            <img src="{{url('assets/logoAgro.png')}}" width="80" alt="Logo">
        </a>


        <!-- Contenido del Navbar -->
        <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarContent">
            <!-- Opciones principales a la izquierda -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('*explotaciones*') ? 'active' : '' }}" href="{{ url('/explotaciones') }}">Explotaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('trabajadores') ? 'active' : '' }}" href="{{ url('/trabajadores') }}">Trabajadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('informes') ? 'active' : '' }}" href="{{ url('/informes') }}">Informes</a>
                </li>
            </ul>

            <!-- Opciones de usuario a la derecha -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item p-1">
                    <a class="nav-link" href="#">Mi perfil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

