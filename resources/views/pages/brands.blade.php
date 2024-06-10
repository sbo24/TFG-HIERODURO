@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')


<div class="container mt-20 mt-sm-0">
    <div class="row">
        @foreach ($marcas as $marca)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
            <div class="card h-100 d-flex flex-column">
                <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1"></div>
                    <a href="/marcas/{{ $marca->nombre }}" class="align-self-center mb-3 text-center">
                        <img class="img-fluid w-75" src="/img/Brands/{{ $marca->nombre }}.png" alt="{{ $marca->nombre }}">
                    </a>
                    <div class="text-center">
                        <h5 class="card-title">{{ $marca->nombre }}</h5>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



@include('news.news')










@include('components.footer')
@endsection

@vite(['resources/js/vehicleApp.js', 'resources/js/newsApp.js'])

@section('scripts')
@include('assets.vehicle.vehiclejs')
@endsection