@extends('layouts.app')

@section('head')
@include('assets.userSite.user')
@endsection

@section('content')
@include('components.header')

<section class="intro-section mt-20 mt-sm-0">
    <div class="container p-4 bg-black text-white">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1 class="display-3 mb-4">¡Bienvenido a tu Área Privada!</h1>
                <p class="lead">Descubre el acceso exclusivo a las últimas noticias, eventos y actualizaciones del mundo automotriz.</p>
                <p class="lead">¡Explora y mantente al tanto de todo lo que te interesa!</p>
            </div>
        </div>
    </div>
</section>

<div class="container mt-5 ">
    <h2 class="mb-5 text-center">Mis Vehículos</h2>
</div>

<div class="mt-5">
    <div id="user-components">
        <father></father>
    </div>
    <div id="newcar">
        <newcar></newcar>
    </div>
</div>



@include('components.footer')
@endsection

@vite('resources/js/userApp.js')
@section('scripts')
@include('assets.userSite.userjs')


@endsection