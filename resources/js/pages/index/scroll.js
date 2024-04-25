document.addEventListener("DOMContentLoaded", function () {
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
