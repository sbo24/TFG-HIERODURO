<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página No Encontrada</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .illustration img {
            max-width: 100%;
            height: auto;
        }

        .message {
            font-size: 32px;
            font-weight: bold;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .description {
            font-size: 20px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .btn-home {
            font-size: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-home:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="illustration">
            <img id="errorImage" src="" alt="Grúa llevándose un coche">
        </div>
        <div class="message">
            ¡Oops! Página No Encontrada (404)
        </div>
        <div class="description">
            Lo sentimos, pero la página que buscas no existe. Parece que se la ha llevado una grúa.
        </div>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Volver al Inicio</a>
    </div>

    <script>
        // Array de URLs de las imágenes de error
        var errorImages = [
            "../../img/error/error1.gif",
            "../../img/error/error2.gif",
            "../../img/error/error3.gif",
            "../../img/error/error4.gif",
        ];

        // Obtener un número aleatorio para seleccionar una imagen de error
        var randomIndex = Math.floor(Math.random() * errorImages.length);

        // Obtener la imagen de error con el índice aleatorio y establecer su src
        var errorImage = document.getElementById("errorImage");
        errorImage.src = errorImages[randomIndex];
    </script>
</body>

</html>