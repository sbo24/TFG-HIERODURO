@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')

<section class="hero-section mt-20 mt-sm-0">
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


@include('news.news')

@include('components.footer')
@endsection

@vite(['resources/js/vehicleApp.js', 'resources/js/newsApp.js'])

@section('scripts')
@include('assets.vehicle.vehiclejs')
@endsection