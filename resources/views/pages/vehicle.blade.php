@extends('layouts.app')

@section('head')
@include('assets.vehicle.vehicle')
@endsection

@section('content')
@include('components.header')





@include('components.footer')
@endsection

@section('scripts')
@include('assets.vehicle.vehiclejs')


@endsection