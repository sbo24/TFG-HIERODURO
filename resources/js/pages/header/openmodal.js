document.addEventListener('DOMContentLoaded', function () {
    // Función para verificar y mostrar los errores de validación en el modal de inicio de sesión
    function checkLoginValidationErrors() {
        const loginModal = document.getElementById('loginModal');
        const validationErrors = loginModal.querySelectorAll('.is-invalid');

        // Si hay errores de validación, abrir el modal de inicio de sesión
        if (validationErrors.length > 0 && !isModalOpen()) {
            const loginModalInstance = new bootstrap.Modal(loginModal, {});
            loginModalInstance.show();
        }
    }

    // Función para verificar si algún modal está abierto
    function isModalOpen() {
        return $('.modal').hasClass('show');
    }

    // Verificar si hay errores de validación en el modal de inicio de sesión al cargar la página
    checkLoginValidationErrors();
});
