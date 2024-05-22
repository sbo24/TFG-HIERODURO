@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header bg-black text-white text-center">
                    <h1 class="mb-0"><i class="bi bi-shield-lock"></i> Recuperación de Contraseña</h1>
                </div>
                <div class="card-body bg-light">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-block btn-lg">{{ __('Enviar Enlace') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-black">
                    <div class="text-center text-white">
                        <a href="{{ url('/') }}" class="text-decoration-none text-white">{{ __('Volver') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection