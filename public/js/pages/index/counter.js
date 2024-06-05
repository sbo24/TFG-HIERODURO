// Hacer una solicitud AJAX para obtener el número total de marcas
$.ajax({
    url: '/marcas/total',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        $('#countMarcas').text(data.total_marcas);
    },
    error: function (xhr, status, error) {
        console.error("Error obteniendo el número total de marcas:", error);
    }
});

// Hacer una solicitud AJAX para obtener el número total de modelos
$.ajax({
    url: '/modelos/total',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        $('#countModelos').text(data.total_modelos);
    },
    error: function (xhr, status, error) {
        console.error("Error obteniendo el número total de modelos:", error);
    }
});

// Hacer una solicitud AJAX para obtener el número total de usuarios registrados
$.ajax({
    url: '/usuarios/total',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        $('#countUsuarios').text(data.total_usuarios);
    },
    error: function (xhr, status, error) {
        console.error("Error obteniendo el número total de usuarios registrados:", error);
    }
});

// Función para animar los números de los contadores
// Función para animar los números de los contadores
function animateValue(id, start, end, duration) {
    if (typeof start !== 'number' || typeof end !== 'number' || isNaN(start) || isNaN(end)) {
        console.error("Error en los valores de inicio y fin para la animación:", start, end);
        return;
    }

    var range = end - start;
    var current = start;
    var increment = end > start ? Math.ceil(range / (duration / 50)) : Math.floor(range / (duration / 50)); // Incremento para terminar en 50 iteraciones
    var obj = document.getElementById(id);
    var startTime = performance.now(); // Obtener el tiempo de inicio

    function updateCounter() {
        var elapsedTime = performance.now() - startTime; // Tiempo transcurrido desde el inicio de la animación
        if (elapsedTime < duration) {
            current = start + increment * (elapsedTime / duration); // Calcular el valor actual interpolado
            obj.innerText = Math.floor(current); // Actualizar el contador con el valor actual
            requestAnimationFrame(updateCounter); // Solicitar la próxima actualización del contador
        } else {
            obj.innerText = end; // Establecer el valor final una vez que se complete la animación
        }
    }

    updateCounter(); // Iniciar la animación
}

// Opciones para el observador de intersección
var options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
};

// Crear un observador de intersección
var observer = new IntersectionObserver(function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            var count = entry.target.querySelector('span').innerText;
            if (!isNaN(count)) { // Verificar si el contador es un número válido antes de iniciar la animación
                animateValue(entry.target.querySelector('span').id, 0, count, 2000); // Animar en un máximo de 2 segundos (2000ms)
            } else {
                console.error("El valor del contador no es un número válido:", count);
            }
            observer.unobserve(entry.target);
        }
    });
}, options);

// Observar cada contador
var counters = document.querySelectorAll('.counter');
counters.forEach(function (counter) {
    observer.observe(counter);
});

