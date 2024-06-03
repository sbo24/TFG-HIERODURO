<!-- resources/views/admin/content/carusel/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Barra lateral izquierda -->
        @include('admin.components.sidebar')

        <!-- Contenido principal -->
        <div class="col-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="m-0">Crear Nuevo Carrusel</h1>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('content.carusel.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="key" class="col-form-label">Clave</label>
                            <input type="text" id="key" name="key" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="values" class="col-form-label">Valores</label>
                            <div class="list-group">
                                @foreach(['es', 'en'] as $language)
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="value-{{ $language }}" class="col-form-label">{{ strtoupper($language) }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea id="value-{{ $language }}" name="values[{{ $language }}][value]" class="form-control" rows="4" required></textarea>
                                            <input type="hidden" name="values[{{ $language }}][language]" value="{{ $language }}">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Crear Carrusel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection