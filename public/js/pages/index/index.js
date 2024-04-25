
       
            var navbar = $('.navbar');

            $(window).scroll(function () {
                var scrollTop = $(this).scrollTop();

                if (scrollTop > 0) { // Si el usuario ha comenzado a hacer scroll hacia abajo
                    navbar.addClass('navbar-dark');
                    $('.navbar-brand img').addClass('invert-logo');
                    $('.modal-content').addClass('modal-dark');
                    if (!$('.navbar').hasClass('at-top')) {
                        $('.d-lg-block .btn').addClass('btn-scroll'); // Agrega clase específica para botones en scroll
                    }
                } else { // Si el usuario está en la parte superior de la página
                    navbar.removeClass('navbar-dark');
                    $('.navbar-brand img').removeClass('invert-logo');
                    $('.modal-content').removeClass('modal-dark');
                    $('.d-lg-block .btn').removeClass('btn-scroll'); // Remueve clase específica para botones en scroll
                }
            });
        

  
       
            const circles = document.querySelectorAll('.circle');

            circles.forEach((circle, index) => {
                setTimeout(() => {
                    circle.classList.add('show');
                }, index * 200); // Delay each circle by 200 milliseconds
            });
        
 
        
            $('#navbar-toggler').click(function () {
                $('#blur-effect').toggle();
            });
        
 
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
        
       
            var animatedElements = document.querySelectorAll('.animated-container');

            function handleScrollAnimation() {
                animatedElements.forEach(function (animatedElement) {
                    var distanceToTop = animatedElement.getBoundingClientRect().top;
                    var windowHeight = window.innerHeight || document.documentElement.clientHeight;
                    var distance = windowHeight - distanceToTop;

                    if (distance > 300) {
                        animatedElement.classList.add('visible');
                    }
                });
            }

            window.addEventListener('scroll', handleScrollAnimation);
            handleScrollAnimation();
      
 
        
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");

            // Mostrar o ocultar el botón cuando el usuario se desplaza hacia abajo
            window.addEventListener("scroll", function () {
                if (window.pageYOffset > 100) {
                    scrollToTopBtn.style.display = "block";
                } else {
                    scrollToTopBtn.style.display = "none";
                }
            });

            // Scroll al principio de la página cuando se hace clic en el botón
            scrollToTopBtn.addEventListener("click", function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" // Para un desplazamiento suave
                });
            });
        });

   
