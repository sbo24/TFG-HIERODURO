@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Barra lateral izquierda -->
        @include('admin.components.sidebar')

        <div class="col-9">

            <!-- Buscador -->
            <div class="mb-3 mt-5">
                <input type="text" class="form-control" id="searchInput" placeholder="Buscar">
            </div>
            <!-- Detalles -->
            <div id="detailsContainer">
                @foreach($details as $detail)
                <div class="container mt-4 detail-item">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $detail->titulo }}</h3>
                                    <form method="POST" action="{{ route('detalle.update', $detail->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <textarea class="form-control" name="descripcion" rows="8" cols="80">
                                        {{ app()->getLocale() == 'en' ? $detail->descripcion_en : $detail->descripcion }}
                                        </textarea>

                                        <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('lenguage')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const detailItems = document.querySelectorAll('.detail-item');

        searchInput.addEventListener('input', function() {
            const searchText = this.value.trim().toLowerCase();

            detailItems.forEach(function(item) {
                const detailContent = item.querySelector('textarea').textContent.toLowerCase();
                if (detailContent.includes(searchText)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection