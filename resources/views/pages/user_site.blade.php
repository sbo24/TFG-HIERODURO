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
                <p class="lead">Descubre el acceso exclusivo a las últimas noticias, eventos y actualizaciones del
                    mundo
                    automotriz.</p>
                <p class="lead">¡Explora y mantente al tanto de todo lo que te interesa!</p>
            </div>
        </div>
    </div>
</section>



<div class="container mt-5 ">
    <h2 class="mb-5 text-center">Mis Vehículos</h2>

    <!-- Filtros -->
    <div class="row mb-4">
        <div class="col-md-3">
            <label for="yearFilter" class="form-label">Año:</label>
            <select class="form-select" id="yearFilter">
                <option value="">Todos</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <!-- Agregar más años si es necesario -->
            </select>
        </div>
        <div class="col-md-3">
            <label for="brandFilter" class="form-label">Marca:</label>
            <select class="form-select" id="brandFilter">
                <option value="">Todas</option>
                <option value="Toyota">Toyota</option>
                <option value="Ford">Ford</option>
                <option value="Chevrolet">Chevrolet</option>
                <!-- Agregar más marcas si es necesario -->
            </select>
        </div>
        <div class="col-md-3">
            <label for="brandFilter" class="form-label">Combustible:</label>
            <select class="form-select" id="brandFilter">
                <option value="">Todas</option>
                <option value="Toyota">Toyota</option>
                <option value="Ford">Ford</option>
                <option value="Chevrolet">Chevrolet</option>
                <!-- Agregar más marcas si es necesario -->
            </select>
        </div>
        <div class="col-md-3">
            <label for="brandFilter" class="form-label">Cambio:</label>
            <select class="form-select" id="brandFilter">
                <option value="">Todas</option>
                <option value="Toyota">Toyota</option>
                <option value="Ford">Ford</option>
                <option value="Chevrolet">Chevrolet</option>
                <!-- Agregar más marcas si es necesario -->
            </select>
        </div>
        <!-- Agregar más filtros aquí -->
    </div>

    <!-- Campo de búsqueda -->
    <div class="input-group mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar vehículo...">
        <button class="btn btn-outline-secondary" type="button" id="searchBtn"><i class="fas fa-search"></i></button>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="vehicleList">
        <!-- Aquí se insertarán dinámicamente las tarjetas de vehículos -->
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-primary" id="loadMoreBtn">Cargar más</button>
    </div>
</div>





@include('components.footer')
@endsection

@section('scripts')
@include('assets.userSite.userjs')
@endsection