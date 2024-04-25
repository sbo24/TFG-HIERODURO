$(document).ready(function () {
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
});