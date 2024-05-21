@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')





<div class="container mt-5">
    <!-- Encabezado de la Marca -->
    <div class="brand-header">
        <img class="brand-logo" src="/img/Brands/{{ $marca->nombre }}.png" alt="{{ $marca->nombre }}">
        <h2 class="brand-name">{{ $marca->nombre }}</h2>
    </div>
    <!-- Grid de Modelos -->
    <div class="model-grid">
        @foreach ($modelos as $modelo)
        <div class="model-card">
            <!-- Imagen del Modelo -->

            <!-- Información del Modelo -->
            <div class="model-info">
                <h3 class="model-title">{{ $modelo->nombre }}</h3>
                <ul class="model-details">
                    @foreach ($modelo->motorizaciones as $motorizacion)

                    <li class="motorization">
                        <strong>Motorización:</strong> {{ $motorizacion->nombre }}
                        <ul class="version-details">
                            @foreach ($motorizacion->codigosVersion as $version)
                            <div class="model-image">
                                <img src="/img/{{ $marca->nombre }}/{{ $modelo->nombre }}/{{ $motorizacion->nombre }}/{{ $version->codigo }}/image1.png" class="vehicle-image w-100" alt="{{ $version->nombre }}">
                            </div>
                            <li class="version">
                                <p class="version-code">Código de Versión: {{ $version->codigo }}</p>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
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
        font-size: 2rem;
        color: #333;
    }

    /* Estilos de la Cuadrícula de Modelos */
    .model-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        grid-gap: 30px;
    }

    .model-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .model-card:hover {
        transform: translateY(-5px);
    }

    .model-image {
        overflow: hidden;
        border-bottom: 1px solid #ddd;
    }

    .model-image img {
        display: block;
        width: 100%;
        height: auto;
    }

    .model-info {
        padding: 20px;
    }

    .model-title {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
        font-size: 1.5rem;
        text-align: center;
    }

    .model-details {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .motorization {
        margin-bottom: 20px;
        color: #555;
    }

    .version {
        padding: 10px;
        border-top: 1px solid #eee;
        color: #666;
        font-size: 0.9rem;
    }

    .version-code {
        margin: 0;
        color: #666;
    }
</style>



@include('components.footer')
@endsection

@vite('resources/js/brandApp.js')

@section('scripts')
@include('assets.vehicle.vehiclejs')


@endsection