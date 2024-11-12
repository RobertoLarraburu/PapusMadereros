document.addEventListener("DOMContentLoaded", function() {
    const registerForm = document.getElementById("register-form");
    const registerBtn = document.getElementById("register-btn");

    registerBtn.addEventListener("click", function(event) {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        fetch("http://localhost/lumen/public/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ name, email, password })
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 201) {
                // Registro exitoso
                Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    text: body.message,
                    confirmButtonText: 'Iniciar Sesión'
                }).then(() => {
                    window.location.href = "login.html"; // Redirige al login
                });
            } else if (status === 409) {
                // El correo ya está registrado
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el registro',
                    text: body.message,
                    confirmButtonText: 'Aceptar'
                });
            } else {
                // Otro error
                throw new Error(body.message || "Ocurrió un error en el registro.");
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message,
                confirmButtonText: 'Aceptar'
            });
        });
    });
});
