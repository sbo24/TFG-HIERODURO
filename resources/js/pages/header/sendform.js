document.addEventListener('DOMContentLoaded', function () {
    const loginButton = document.getElementById('loginButton');

    loginButton.addEventListener('click', function () {
        // Guardar la URL actual en localStorage
        localStorage.setItem('currentUrl', window.location.href);

        const formData = new FormData(document.getElementById('loginForm'));
        fetch('{{ route("login") }}', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Obtener la URL almacenada en localStorage
                    const redirectUrl = localStorage.getItem('currentUrl');
                    if (redirectUrl) {
                        // Redirigir al usuario a la URL almacenada
                        window.location.href = redirectUrl;
                    } else {
                        // Redirigir al usuario a una página predeterminada si no hay URL almacenada
                        window.location.href = '{{ route("defaultRoute") }}';
                    }
                } else {
                    // Mostrar errores de validación si los hay
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
