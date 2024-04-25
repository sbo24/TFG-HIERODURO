document.addEventListener("DOMContentLoaded", function () {
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
});
