document.addEventListener('DOMContentLoaded', function () {
    const circles = document.querySelectorAll('.circle');

    circles.forEach((circle, index) => {
        setTimeout(() => {
            circle.classList.add('show');
        }, index * 200); // Delay each circle by 200 milliseconds
    });
});