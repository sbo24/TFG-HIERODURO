

<div id="blur-effect" class="blur-effect"></div>

<header>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm  ">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vehículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Comparar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center justify-content-center ms-lg-3">
                    <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Iniciar Sesión</button>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</button>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Modal de Iniciar Sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Contenido del modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido del formulario de inicio de sesión -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Iniciar Sesión</button>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Registrarse</button>
            </div>
        </div>
    </div>
</div>