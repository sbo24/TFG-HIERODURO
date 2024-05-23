@extends('layouts.app')

@section('head')
@include('assets.index.index')
@endsection

@section('content')
@include('components.header')
<div id="carousel" class="carousel slide mt-20  mt-lg-5" data-bs-ride="carousel">
    <div class="carousel-inner py-4">
        <div class="carousel-item active py-4">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Columna de texto e información -->
                    <div class="col-md-6 text-center text-lg-start mb-4 mb-lg-0">
                        <h1 class="display-1 text-uppercase fw-bold">Alfa Romeo</h1>
                        <h2 class="display-4 fw-normal text-secondary">4C</h2>
                        <p class="lead">El Alfa Romeo 4C es un modelo emblemático conocido por su diseño elegante y su potente motor. Su combinación de estilo italiano y rendimiento deportivo lo convierte en un automóvil deseable para los entusiastas de los vehículos deportivos.</p>
                        <ul class="list-unstyled animated">
                            <li><strong>Motor:</strong> 1.75L Turbo Gasolina</li>
                            <li><strong>Potencia:</strong> 240 CV</li>
                            <li><strong>Velocidad Máxima:</strong> 258 km/h</li>
                            <li><strong>0-100 km/h:</strong> 4.5 segundos</li>
                            <li><strong>Precio de salida:</strong> Desde 60.000€</li>
                        </ul>
                    </div>
                    <!-- Columna de imagen -->
                    <div class="col-md-6 text-center">
                        <img src="../../img/carusel/caruselalfa.png" class="img-fluid" alt="Alfa Romeo 4C">
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item py-4">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Columna de texto e información -->
                    <div class="col-md-6 text-center text-lg-start mb-4 mb-lg-0">
                        <h1 class="display-1 text-uppercase fw-bold text-shadow">Audi A5</h1>
                        <h2 class="display-4 fw-normal text-muted">3.0 TDI</h2>
                        <p class="lead">El Audi A5 3.0 TDI es un automóvil elegante y potente que combina el lujo con un rendimiento impresionante. Con su motor diésel de alta eficiencia y su diseño aerodinámico, ofrece una experiencia de conducción excepcional tanto en carretera como en ciudad.</p>
                        <ul class="list-unstyled animated">
                            <li><strong>Motor:</strong> 3.0L TDI Diesel</li>
                            <li><strong>Potencia:</strong> 286 CV</li>
                            <li><strong>Velocidad Máxima:</strong> 250 km/h</li>
                            <li><strong>0-100 km/h:</strong> 5.7 segundos</li>
                            <li><strong>Precio de salida:</strong> Desde 50.000€</li>
                        </ul>
                    </div>
                    <!-- Columna de imagen -->
                    <div class="col-md-6 text-center">
                        <img src="../../img/carusel/caruselaudi.png" class="img-fluid" alt="Audi A5 3.0 TDI">
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item py-4">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Columna de texto e información -->
                    <div class="col-md-6 text-center text-lg-start mb-4 mb-lg-0">
                        <h1 class="display-1 text-uppercase fw-bold text-shadow">BMW Serie 3</h1>
                        <h2 class="display-4 fw-normal text-muted">F80</h2>
                        <p class="lead">El BMW Serie 3 F80 es un sedán deportivo que combina elegancia con rendimiento. Equipado con tecnología de vanguardia y un potente motor, ofrece una experiencia de conducción emocionante tanto en carreteras sinuosas como en autopistas.</p>
                        <ul class="list-unstyled animated ">
                            <li><strong>Motor:</strong> 3.0L Twin-Turbo Inline-6</li>
                            <li><strong>Potencia:</strong> 431 CV</li>
                            <li><strong>Velocidad Máxima:</strong> 250 km/h</li>
                            <li><strong>0-100 km/h:</strong> 4.1 segundos</li>
                            <li><strong>Precio de salida:</strong> Desde 70.000€</li>
                        </ul>
                    </div>
                    <!-- Columna de imagen -->
                    <div class="col-md-6 text-center">
                        <img src="../../img/carusel/caruselhellcar.png" class="img-fluid" alt="BMW Serie 3 F80">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>





<div class="bg-black ">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-3 col-sm-6 text-center">
                <div class="circle bg-primary text-white rounded-circle mx-auto mb-3">
                    <i class="fas fa-handshake fa-3x"></i>
                </div>
                <h3 class="h5 mb-3 text-white">Duelos</h3>
                <p class="text-white"> ¡Compite en emocionantes desafíos!</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="circle bg-success text-white rounded-circle mx-auto mb-3">
                    <i class="fas fa-car fa-3x"></i>
                </div>
                <h3 class="h5 mb-3 text-white">Coches</h3>
                <p class="text-white">¡Descubre las últimas novedades del mundo del motor!</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="circle bg-warning text-white rounded-circle mx-auto mb-3">
                    <i class="fas fa-user fa-3x"></i>
                </div>
                <h3 class="h5 mb-3 text-white">Mi Área</h3>
                <p class="text-white">¡Gestiona tu perfil y tus preferencias!</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="circle bg-info text-white rounded-circle mx-auto mb-3">
                    <i class="fas fa-info-circle fa-3x"></i>
                </div>
                <h3 class="h5 mb-3 text-white">Quiénes Somos</h3>
                <p class="text-white">¡Conoce más sobre nosotros y nuestra misión!</p>
            </div>
        </div>
    </div>
</div>


<div class="container mt-10 mb-5 hidden slide-in animated-container">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <img src="https://cdn.pixabay.com/photo/2018/05/02/09/29/auto-3368094_1280.jpg" class="img-fluid rounded shadow-lg" alt="Imagen de vehículo">
        </div>
        <div class="col-lg-6 align-self-center">
            <div class=" text-md-start">
                <h2 class="fw-bold text-dark mb-4">Optimiza el Cuidado de tu Vehículo con Nuestra Plataforma</h2>
                <p class="mb-4 text-secondary">Registra, programa y sigue el mantenimiento de tus autos fácilmente.
                    Recibe
                    recordatorios y compara su rendimiento para una conducción segura y placentera siempre.</p>
                <div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-check-circle text-success me-3" aria-hidden="true"></i>
                        <div>
                            <h4 class="mb-1 text-dark">Aceite al dia</h4>
                            <p class="mb-0 text-secondary">Preocupate de lo que de verdad importa.</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-check-circle text-success me-3" aria-hidden="true"></i>
                        <div>
                            <h4 class="mb-1 text-dark">Correa a punto</h4>
                            <p class="mb-0 text-secondary">Seguridad en cada giro.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container mt-5 hidden slide-in animated-container shadow-lg rounded p-3">
    <div class="bg-white p-4 rounded">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="counter text-center">
                    <h2><i class="fas fa-tag"></i> <span id="count1" class="counter-value">500</span></h2>
                    <p class="text-muted">Marcas Totales</p>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="counter text-center">
                    <h2><i class="fas fa-car"></i> <span id="count2" class="counter-value">2000</span></h2>
                    <p class="text-muted">Modelos Totales</p>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="counter text-center">
                    <h2><i class="fas fa-users"></i> <span id="count3" class="counter-value">10000</span></h2>
                    <p class="text-muted">Usuarios Registrados</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="bg-black hidden slide-in animated-container">
    <div class="container mt-5 text-white hidden slide-in animated-container py-5">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="../../img/izquierda.png" alt="Imagen Izquierda" class="img-fluid w-100 rounded ">
            </div>
            <div class="col-md-4 text-center">
                <h2 class="mt-5 font-weight-bold">¡Bienvenido a la Arena de Duelos de Vehículos!</h2>
                <p class="mt-4 lead">Descubre el vehículo perfecto para ti</p>
                <p class="mt-4">En esta exclusiva sección, podrás comparar y analizar una amplia gama de vehículos
                    para
                    encontrar el mejor para tus necesidades. Desafía a otros usuarios y demuestra tu conocimiento
                    automotriz
                    en emocionantes duelos.</p>
                <div class=" mt-5">
                    <a href="{{ route('comparation') }}" class="btn btn-success btn-lg btn-block rounded-pill">¡Explora Ahora!</a>
                </div>
            </div>
            <div class="col-md-4">
                <img src="../../img/derecha.png" alt="Imagen Derecha" class="img-fluid w-100 rounded ">
            </div>
        </div>
    </div>
</div>

@include('lenguage')
@include('components.footer')
@endsection

@section('scripts')

@include('assets.index.indexjs')
@include('assets.header.headerjs')
@endsection