<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Estilos del botón y del menú desplegable con clase única */
        .btn-idiomas {
            position: fixed;
            top: 50%;
            right: 10px;
            /* Alinear el botón a la derecha */
            transform: translateY(-50%);

            /* Color del botón */
            color: white;
            padding: 5px 10px;
            /* Ajustar el padding para hacer el botón más pequeño */
            font-size: 12px;
            /* Ajustar el tamaño del texto */
            border: none;
            cursor: pointer;
            border-radius: 5px;

            z-index: 1000;
        }

        .btn-idiomas img {
            width: 50px;
            /* Ajustar el tamaño de la imagen */
            vertical-align: middle;
            /* Alinear verticalmente la imagen */
            margin-right: 5px;
            /* Añadir un pequeño margen a la derecha de la imagen */
        }

        .btn-idiomas:hover .menu-idiomas {
            display: block;
        }

        .menu-idiomas {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 180px;
            right: 1px;
            text-align: center;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .menu-idiomas a {
            color: black;
            padding: 8px 12px;
            /* Ajustar el padding de los elementos de la lista */
            text-decoration: none;
            display: block;
            font-size: 14px;
            /* Ajustar el tamaño del texto de los elementos de la lista */
        }

        .menu-idiomas a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <!-- Contenido de tu página -->

    <div class="btn-idiomas">
        <img src="https://media.tenor.com/aLgQw5HZ2pMAAAAi/dazzle-car-detailing.gif" alt="">

        <div class="menu-idiomas">
            <a href="{{ route('changeLanguage', 'en') }}">English</a>
            <a href="{{ route('changeLanguage', 'es') }}">Español</a>
        </div>
    </div>

    <!-- Resto del contenido de tu página -->

    <script>
        // Function to handle language switching
        function toggleLanguage(newLang) {
            // Hacer una solicitud fetch para cambiar el idioma
            fetch('/lang/' + newLang, {
                    method: 'GET'
                })
                .then(response => {
                    if (response.ok) {
                        // Recargar la página para aplicar el nuevo idioma
                        window.location.reload();
                    } else {
                        console.error('Error al cambiar el idioma');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>