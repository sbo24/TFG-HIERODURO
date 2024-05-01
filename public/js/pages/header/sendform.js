document.addEventListener('DOMContentLoaded', function () {
    // Capturamos el botón de inicio de sesión
    const loginButton = document.getElementById('loginButton');
    // Agregamos un evento de clic al botón
    loginButton.addEventListener('click', function () {
        // Enviamos el formulario utilizando AJAX
        const formData = new FormData(document.getElementById('loginForm'));
        fetch('{{ route("login") }}', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Si la autenticación es exitosa, redirigimos al usuario
                    window.location.href = data.redirect;
                } else {
                    // Si hay errores de validación, los mostramos en el modal
                    const errors = data.errors;
                    for (const field in errors) {
                        const errorDiv = document.getElementById(field + '-error');
                        errorDiv.innerHTML = errors[field].join('<br>');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    });

    
});