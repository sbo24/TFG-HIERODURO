@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')

<section class="intro-section mt-20 mt-sm-0">
    <div class="container p-4 bg-dark text-white">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1 class="display-3 mb-4">Explora Nuestra Colección de Coches</h1>
                <p class="lead">Accede a una amplia gama de coches disponibles para ti. Descubre modelos, características y mucho más.</p>
                <p class="lead">¡Encuentra el coche de tus sueños!</p>
            </div>
        </div>
    </div>
</section>

<section class="vehicle-gallery py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="display-5">Nuestra Colección de Coches</h2>
                <p class="lead">Explora nuestra amplia gama de coches de alta gama.</p>
            </div>
        </div>

        <div id="vehicle-filters" class="mb-5">
            <filters></filters>
        </div>

    </div>
</section>

@include('components.footer')
@endsection

@vite('resources/js/vehicleApp.js')

@section('scripts')
<script src="{{ asset('chart.js/chart.js') }}"></script>
@include('assets.vehicle.vehiclejs')
@endsection