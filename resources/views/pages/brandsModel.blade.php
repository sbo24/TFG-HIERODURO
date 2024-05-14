@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')


<section class="intro-section mt-20 mt-sm-0">
    <div class="container p-4 bg-black text-white">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1 class="display-3 mb-4">¡Bienvenido a tu JEJEJEJEJJ!</h1>
                <p class="lead">Descubre el acceso exclusivo a las últimas noticias, eventos y actualizaciones del mundo automotriz.</p>
                <p class="lead">¡Explora y mantente al tanto de todo lo que te interesa!</p>
            </div>
        </div>
    </div>
</section>



@foreach ($modelos as $modelo)
<li>{{ $modelo->nombre }}</li>
@endforeach





@include('components.footer')
@endsection


@vite('resources/js/brandApp.js')

@section('scripts')
<script src="{{ asset('chart.js/chart.js') }}"></script>
@include('assets.vehicle.vehiclejs')


@endsection