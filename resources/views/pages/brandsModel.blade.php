@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')






<div class="container mt-5">
    <div class="d-flex justify-content-center">
            <img class="img-fluid w-10" src="/img/Brands/{{ $marca->nombre }}.png" alt="{{ $marca->nombre }}">
    </div>
    <h2 class="text-center">{{ $marca->nombre }}</h2>
    <div class="row">
        @foreach ($modelos as $modelo)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ $modelo->nombre }}</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($modelo->motorizaciones as $motorizacion)
                        <li class="list-group-item">
                            <strong>Motorización:</strong> {{ $motorizacion->nombre }}
                            <ul class="list-group list-group-flush">
                                @foreach ($motorizacion->codigosVersion as $version)
                                <div class="text-center mt-3">
                                    <img src="/img/{{ $marca->nombre }}/{{ $modelo->nombre }}/{{ $motorizacion->nombre }}/{{ $version->codigo }}/image1.png" class="img-fluid vehicle-image " alt="{{ $version->nombre }}">
                                </div>
                                <li class="list-group-item text-center">Código de Versión: {{ $version->codigo }}</li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .vehicle-image {
        max-height: 150px;
        object-fit: contain;
    }

    .w-10{
        width: 10%;
    }
</style>



@include('components.footer')
@endsection

@vite('resources/js/brandApp.js')

@section('scripts')
<script src="{{ asset('chart.js/chart.js') }}"></script>
@include('assets.vehicle.vehiclejs')


@endsection