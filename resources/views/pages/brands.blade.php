@extends('layouts.app')

@section('head')
@include('assets.brands.brands')
@endsection

@section('content')
@include('components.header')


<section class="intro-section mt-20 mt-sm-0">
    <div class="container p-4 bg-black text-white">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1 class="display-3 mb-4">¡Bienvenido a tu Espacio de Marcas!</h1>
                <p class="lead">Sumérgete en el apasionante mundo automotriz y explora una amplia selección de marcas líderes en la industria.</p>
                <p class="lead">Aquí encontrarás acceso exclusivo a las últimas novedades, eventos emocionantes y actualizaciones relevantes.</p>
                <p class="lead">¡Explora nuestras marcas y mantente al tanto de todo lo que te interesa!</p>
            </div>
        </div>
    </div>
</section>



<div class="container mt-5">
    <div class="row align-items-stretch"> <!-- Cambiado a align-items-stretch para que todas las columnas tengan la misma altura -->
        @foreach ($marcas as $marca)
        <div class="col-md-3">
            <div class="marca text-center">
                <a href="/marcas/{{ $marca->nombre }}">
                    <img class="img-fluid w-50" src="/img/Brands/{{ $marca->nombre }}.png" alt="{{ $marca->nombre }}">
                </a>
                <div class="row mt-3">
                    <div class="col">
                        <h4>{{ $marca->nombre }}</h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>







@include('components.footer')
@endsection




@section('scripts')

@include('assets.brands.brandsjs')


@endsection