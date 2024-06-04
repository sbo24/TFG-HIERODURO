<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="comparativa de coches, fichas técnicas de coches, comparación de precios, especificaciones de coches, seguridad de coches, consumo de combustible, espacio interior, tecnología de coches, rendimiento de coches, opiniones de expertos, valoraciones, análisis de características, capacidad de carga, diseño exterior">
    <meta name="description" content="Encuentra comparativas de coches, fichas técnicas detalladas y análisis exhaustivos de precios, características y rendimiento de una amplia gama de vehículos. Nuestra plataforma te ayuda a tomar decisiones informadas al comprar un coche nuevo o usado. Explora las últimas novedades en tecnología, seguridad y diseño automotriz con nuestras valoraciones expertas y opiniones imparciales.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hierro Duro') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('img/header.png') }}">

    @yield('head')
</head>

<body>
    @yield('content')
    @include('partials.cookie-banner')

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    @if(Session::has('admin_welcome'))
    <script>
        toastr.success("{{ Session::get('admin_welcome') }}");
    </script>
    @endif

    @if(Session::has('error_message'))
    <script>
        toastr.error("{{ Session::get('error_message') }}");
    </script>
    @endif

    @if(session('error_auth'))
    <script>
        toastr.error("{{ session('error_auth') }}");
    </script>
    @endif






    @yield('scripts')
</body>

</html>