<div id="blur-effect" class="blur-effect"></div>

<header>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="../../img/header.png" alt="Logo" class="d-inline-block align-text-top animated fadeInUp">
            </a>
            <button id="navbar-toggler" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end animated fadeInUp" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicle') }}">Vehículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comparation') }}">Comparar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user') }}">Mi Área</a>
                    </li>
                </ul>
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center text-center text-lg-start ms-lg-3">
                    @auth
                    <div class="dropdown mr-1">
                        <button class="btn btn-outline-dark dropdown-toggle me-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Bienvenido, {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user') }}">Mi Área</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    @else
                    <div class="mt-3 mt-lg-0">
                        <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</button>
                    </div>
                    @endauth
                </div>

            </div>
        </div>
    </nav>
</header>

<!-- Modal de Iniciar Sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de inicio de sesión -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control custom-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control custom-input @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input custom-checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recuérdame</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Iniciar Sesión</button>
                        <a href="{{ route('google.redirect') }}" class="btn btn-google btn-lg"><i class="fab fa-google"></i> Iniciar sesión con Google</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>



<!-- Modal de Registrarse -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Contenido del modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del formulario de registro -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" class="form-control custom-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                        <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                        <a href="{{ route('google.redirect') }}" class="btn btn-google btn-lg"><i class="fab fa-google"></i> Registrarse con Google</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>