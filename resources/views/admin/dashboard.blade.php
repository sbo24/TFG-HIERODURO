@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection     

@section('content')
<div class="container-fluid">
    <div class="row flex-nowrap">
        @include('admin.components.sidebar')
        <div class="col py-3">
            <h3>Panel de Administración</h3>
            <p class="lead">
                Un panel de administración intuitivo y poderoso diseñado para gestionar eficientemente el contenido y las configuraciones del sitio web. Ofrece una amplia gama de funciones y características que facilitan la gestión de contenido, la administración de usuarios, la personalización del diseño y mucho más.
            </p>

        </div>
    </div>
</div>
@endsection

@include('assets.vehicle.vehiclejs')