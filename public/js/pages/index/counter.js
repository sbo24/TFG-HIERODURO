// Función para animar los números de los contadores
function animateValue(id, start, end, duration) {
    var range = end - start;
    var current = start;
    var increment = end > start ? Math.ceil(range / (duration / 45)) : Math.floor(range / (duration / 50)); // Incremento para terminar en 50 iteraciones
    var stepTime = Math.abs(Math.floor(duration / 20)); // Tiempo entre cada iteración
    var obj = document.getElementById(id);
    var timer = setInterval(function () {
        current += increment;
        obj.innerText = current;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) { // Detener la animación al alcanzar el valor final
            obj.innerText = end;
            clearInterval(timer);
        }
    }, stepTime);
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
            animateValue(entry.target.querySelector('span').id, 0, count, 2000); // Animar en un máximo de 2 segundos (2000ms)
            observer.unobserve(entry.target);
        }
    });
}, options);

// Observar cada contador
var counters = document.querySelectorAll('.counter');
counters.forEach(function (counter) {
    observer.observe(counter);
});