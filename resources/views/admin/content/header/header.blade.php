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
                    <h1 class="m-0">Contenido del Header</h1>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('content.header.update') }}" method="POST">
                        @csrf
                        @foreach($contentKeys as $key)
                        <div class="mb-4">
                            <h4 class="card-title mb-3">{{ $key->key }}</h4>
                            <div class="list-group">
                                @foreach($key->values as $value)
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="content-{{ $value->id }}" class="col-form-label">{{ strtoupper($value->language) }}</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" id="content-{{ $value->id }}" name="content[{{ $value->id }}][value]" class="form-control" value="{{ $value->value }}">
                                            <input type="hidden" name="content[{{ $value->id }}][id]" value="{{ $value->id }}">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
