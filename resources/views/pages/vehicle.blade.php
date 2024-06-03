@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')

<section class="hero-section">
    <div class="container-fluid hero-bg">
        <div class="row align-items-center">
            <div class="col-lg-6 offset-lg-3 text-center">
                <h1 class="display-4 text-uppercase font-weight-bold">Descubre Tu Próximo Vehículo</h1>
                <p class="mt-3 mb-5 hero-text">Una selección exclusiva de coches para los entusiastas del automovilismo.</p>
            </div>
        </div>
    </div>
</section>

<div id="vehicle-filters" class="mb-5">
    <filters></filters>
</div>

<section class="news-section bg-light py-5">
    <div class="container">
        <h2 class="display-6 text-center mb-5 section-title">Noticias del Motor</h2>
        <div class="row d-flex align-items-stretch">
            <div class="col-md-4 mb-4">
                <div class="news-card card h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/600x400" alt="Noticia del Motor">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">La Nueva Era de los Supercarros Eléctricos</h5>
                        <p class="card-text">Los fabricantes de supercarros están adoptando la tecnología eléctrica, ofreciendo rendimiento sin precedentes y una nueva experiencia de conducción.</p>
                        <a href="#" class="mt-auto btn btn-outline-primary">Leer Más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="news-card card h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/600x400" alt="Noticia del Motor">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Avances en la Autonomía de Vehículos Autónomos</h5>
                        <p class="card-text">Investigadores han logrado avances significativos en la autonomía de los vehículos, prometiendo una revolución en la movilidad urbana.</p>
                        <a href="#" class="mt-auto btn btn-outline-primary">Leer Más</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="news-card card h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/600x400" alt="Noticia del Motor">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Eventos de Motor que Marcarán el Año</h5>
                        <p class="card-text">Desde carreras legendarias hasta exposiciones de coches clásicos, estos son los eventos que ningún aficionado al motor debería perderse.</p>
                        <a href="#" class="mt-auto btn btn-outline-primary">Leer Más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="maintenance-section py-5">
    <div class="container">
        <h2 class="display-6 text-center mb-5 section-title">Consejos de Mantenimiento</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="maintenance-card card h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/600x400" alt="Cambio de Aceite Regular">
                    <div class="card-body">
                        <h5 class="card-title">Cambio de Aceite Regular</h5>
                        <p class="card-text">Es importante cambiar el aceite del motor de tu vehículo según el intervalo recomendado por el fabricante para mantener su rendimiento y durabilidad.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="maintenance-card card h-100">
                    <img class="card-img-top" src="https://via.placeholder.com/600x400" alt="Mantenimiento de Frenos">
                    <div class="card-body">
                        <h5 class="card-title">Mantenimiento de Frenos</h5>
                        <p class="card-text">Revisa regularmente el estado de los frenos y cambia las pastillas y discos según sea necesario para garantizar la seguridad en la carretera.</p>
                    </div>
                </div>
            </div>
            <!-- Agrega más consejos de mantenimiento aquí -->
        </div>
    </div>
</section>

@include('components.footer')
@endsection

@vite(['resources/js/vehicleApp.js', 'resources/js/newsApp.js'])

@section('scripts')
@include('assets.vehicle.vehiclejs')
@endsection