document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("login-form");
    
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        fetch("http://localhost/lumen/public/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ email, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Guarda el token o un indicador de sesión en localStorage
                localStorage.setItem("isAuthenticated", "true");
                
                // Redirige al usuario a la página de inicio
                Swal.fire({
                    icon: 'success',
                    title: 'Logueado correctamente',
                    text: 'Redireccionando...',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = "/industria/plantilla/index.html";
                });
            } else {
                // Error en el login
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el inicio de sesión',
                    text: 'Correo o contraseña incorrectos',
                    confirmButtonText: 'Aceptar'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error en el inicio de sesión',
                confirmButtonText: 'Aceptar'
            });
            console.error(error);
        });
    });
});
