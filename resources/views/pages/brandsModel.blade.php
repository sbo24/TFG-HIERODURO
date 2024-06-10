@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')





<div class="container ">
    <!-- Encabezado de la Marca -->
    <div class="brand-header mt-20 mt-sm-0">
        <img class="brand-logo" src="/img/Brands/{{ $marca->nombre }}.png" alt="{{ $marca->nombre }}">
        <h2 class="brand-name">{{ $marca->nombre }}</h2>
    </div>
    <!-- Grid de Modelos -->
    <div class="model-grid">
        @foreach ($modelos as $modelo)
        <div class="model-card">
            <!-- Información del Modelo -->
            <div class="model-info">
                <h3 class="model-title">{{ $modelo->nombre }}</h3>
            </div>
            <!-- Imagen y Código de Versión del Modelo -->
            @foreach ($modelo->motorizaciones as $motorizacion)
            @foreach ($motorizacion->codigosVersion as $version)
            <div class="model-version">
                <div class="model-image">
                    <img src="/img/{{ $marca->nombre }}/{{ $modelo->nombre }}/{{ $motorizacion->nombre }}/{{ $version->codigo }}/image1.png" class="vehicle-image w-100" alt="{{ $version->nombre }}">
                </div>
                <div class="version-info">
                    <p class="version-code">Código de Versión: {{ $version->codigo }}</p>
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
        @endforeach
    </div>
</div>



<style>
    /* Estilos Generales */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .brand-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .brand-logo {
        width: 100px;
        height: auto;
    }

    .brand-name {
        font-size: 2.5rem;
        color: #333;
        margin-top: 15px;
    }

    /* Estilos de la Cuadrícula de Modelos */
    .model-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .model-card {
        border: 1px solid #ddd;
        border-radius: 15px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .model-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .model-info {
        padding: 20px;
        text-align: center;
    }

    .model-title {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
        font-size: 1.75rem;
    }

    .model-version {
        padding: 20px;
    }

    .model-image {
        overflow: hidden;
        border-bottom: 1px solid #ddd;
    }

    .model-image img {
        display: block;
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }

    .model-card:hover .model-image img {
        transform: scale(1.05);
    }

    .version-info {
        padding: 10px 0;
        text-align: center;
        background-color: #f9f9f9;
        border-top: 1px solid #eee;
    }

    .version-code {
        margin: 0;
        color: #333;
        font-size: 1rem;
    }
</style>



@include('components.footer')
@endsection

@vite('resources/js/brandApp.js')

@section('scripts')
@include('assets.vehicle.vehiclejs')


@endsection