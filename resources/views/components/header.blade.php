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
                        <a class="nav-link" href="{{ route('index') }}">{{ __('header.home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('vehicle') }}">{{ __('header.vehicles') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('brands') }}">{{ __('header.brands') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comparation') }}">{{ __('header.comparison') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user') }}">{{ __('header.my_area') }}</a>
                    </li>
                </ul>
                <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center text-center text-lg-start ms-lg-3">
                    @auth
                    <div class="dropdown mr-1">
                        <button class="btn btn-outline-dark dropdown-toggle me-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('header.welcome', ['name' => Auth::user()->name]) }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user') }}">{{ __('header.my_area') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('header.logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="mt-3 mt-lg-0">
                        <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('header.login') }}</button>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registerModal">{{ __('header.register') }}</button>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>


<!-- Modal de Iniciar Sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
                <h5 class="modal-title text-white" id="loginModalLabel">{{ __('header.welcome_back') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de inicio de sesión -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
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

                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">He olvidado mi contraseña</a>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recuérdame</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill">Iniciar Sesión</button>
                        <a href="{{ route('google.redirect') }}" class="btn btn-google rounded-pill shadow-sm px-4 text-white bg-black"><i class="fab fa-google"></i> Iniciar sesión con Google</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal de Registro -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
                <h5 class="modal-title text-white" id="registerModalLabel">Crea tu Cuenta</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-white p-5">
                <!-- Formulario de registro -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" class="form-control custom-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" type="password" class="form-control custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                        <input id="password-confirm" type="password" class="form-control custom-input" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill shadow-sm px-4">Registrarse</button>
                        <a href="{{ route('google.redirect') }}" class="btn btn-google rounded-pill shadow-sm px-4 text-white bg-black"><i class="fab fa-google"></i> Registrarse con Google</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>