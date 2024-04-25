<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="comparativa de coches, fichas técnicas de coches, comparación de precios, especificaciones de coches, seguridad de coches, consumo de combustible, espacio interior, tecnología de coches, rendimiento de coches, opiniones de expertos, valoraciones, análisis de características, capacidad de carga, diseño exterior">
    <meta name="description" content="Encuentra comparativas de coches, fichas técnicas detalladas y análisis exhaustivos de precios, características y rendimiento de una amplia gama de vehículos. Nuestra plataforma te ayuda a tomar decisiones informadas al comprar un coche nuevo o usado. Explora las últimas novedades en tecnología, seguridad y diseño automotriz con nuestras valoraciones expertas y opiniones imparciales.">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/carrusel.css">
    <link rel="stylesheet" href="../../css/counter.css">
    <link rel="stylesheet" href="../../css/circle.css">

</head>

<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="../../js/pages/index/navbar.js"></script>
    <script src="../../js/pages/index/circles.js"></script>
    <script src="../../js/pages/index/blur-effect.js"></script>
    <script src="../../js/pages/index/counter.js"></script>
    <script src="../../js/pages/index/animated-containers.js"></script>
    <script src="../../js/pages/index/scroll.js"></script>
</body>

</html>