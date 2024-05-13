@extends('layouts.app')

@section('head')
@include('assets.comparation.comparation')
@endsection

@section('content')
@include('components.header')


<div id="vehicles-comparation">
    <comparation></comparation>
</div>


@include('components.footer')
@endsection

@vite('resources/js/comparationApp.js')
@section('scripts')
@include('assets.comparation.comparationjs')

@endsection