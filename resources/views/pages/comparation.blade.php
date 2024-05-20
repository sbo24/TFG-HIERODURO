@extends('layouts.app')

@section('head')
@include('assets.comparation.comparation')
@endsection

@section('content')
@include('components.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="text-center">
                <h1 class="mb-4">¡Bienvenido a la Comparación de Vehículos!</h1>
                <p>En nuestra plataforma, puedes comparar las especificaciones técnicas y características de diferentes vehículos para tomar decisiones informadas antes de realizar una compra. Nuestra interfaz intuitiva y fácil de usar te permite comparar motores, estadísticas, chasis y mantenimientos de manera rápida y sencilla.</p>
                <h2 class="mt-5">Características Principales:</h2>
                <ul class="list-group mt-3">
                    <li class="list-group-item">Comparación Detallada</li>
                    <li class="list-group-item">Interfaz Intuitiva</li>
                    <li class="list-group-item">Personalización</li>
                </ul>
                <h2 class="mt-5">¿Cómo Funciona?</h2>
                <ol class="list-group mt-3">
                    <li class="list-group-item">Selecciona tus Vehículos</li>
                    <li class="list-group-item">Explora las Especificaciones</li>
                    <li class="list-group-item">Toma una Decisión Informada</li>
                </ol>
                <p class="mt-5">¡Comienza a comparar ahora mismo y encuentra el automóvil perfecto para ti!</p>
            </div>
        </div>
    </div>
</div>

<div id="vehicles-comparation">
    <comparation></comparation>
</div>


@include('components.footer')
@endsection

@vite('resources/js/comparationApp.js')
@section('scripts')
@include('assets.comparation.comparationjs')

@endsection