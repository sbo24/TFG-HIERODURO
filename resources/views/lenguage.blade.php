<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Incluir Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-mt3RJDOJ2nI5/1i7bexBwz5xvUvhjMt6aTf0sO9t23a0093sgpuvaqqef+jo0+6s" crossorigin="anonymous">

    <style>
     
        /* Estilos del botón y del menú desplegable con clase única */
        .btn-idiomas {
            position: fixed;
            top: 50%;
            right: 10px;
            /* Alinear el botón a la derecha */
            transform: translateY(-50%);
            /* Color del botón */
            color: white;
            padding: 5px 5px;
            /* Ajustar el padding para hacer el botón más pequeño */
            font-size: 8px;
            /* Ajustar el tamaño del texto */
            border: none;
            cursor: pointer;
            border-radius: 5px;
            z-index: 1000;
            /* Fondo del botón: planeta */
            background-color: #333;
            /* Fondo oscuro */
        }

        .btn-idiomas .fa-globe {
            font-size: 3em;
            /* Tamaño del icono */
        }

        .btn-idiomas:hover .menu-idiomas {
            display: block;
        }

        .menu-idiomas {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            right: 1px;
            text-align: center;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .menu-idiomas a {
            color: black;
            padding: 5px 5px;
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
        <i class="fas fa-globe fa-5x"></i> <!-- Tamaño del icono -->
        <div class="menu-idiomas">
            <a href="{{ route('changeLanguage', 'en') }}">En</a>
            <a href="{{ route('changeLanguage', 'es') }}">Es</a>
            <!-- Agrega más enlaces para otros idiomas si es necesario -->
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