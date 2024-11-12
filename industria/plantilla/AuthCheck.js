document.addEventListener("DOMContentLoaded", function () {
    // Verificar si el usuario está autenticado
    if (!localStorage.getItem("isAuthenticated")) {
        // Usar SweetAlert para mostrar el mensaje
        Swal.fire({
            icon: 'warning',
            title: 'No tienes una sesión activa',
            text: 'Inicia sesión, por favor.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            // Redirigir al login después de que el usuario cierre el mensaje
            window.location.href = "/industria/login.html";
        });
    }
});
