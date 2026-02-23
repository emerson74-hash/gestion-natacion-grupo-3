// public/js/services/ui.js

export const handleAlert = (status, message, redirectUrl = null) => {
  switch (status) {
    case "user_exists":
          Swal.fire({
                icon: 'info',
                title: 'Usuario registrado',
                text: message,
                confirmButtonText: 'Ir al Inicio',
                confirmButtonColor: '#0d6efd',
                allowOutsideClick: false // Obligamos a que interactúe con el botón
            }).then((result) => {
                if (result.isConfirmed) {
                    // SOLUCIÓN DEFINITIVA: 
                    // Si redirectUrl es '?url=home', esto construye 'http://localhost/proyecto/?url=home'
                    const destination = window.location.origin + window.location.pathname + (redirectUrl || '');
                    window.location.replace(destination);
                }
            });
            break; 
    /*   alert("Intentando redirigir a: " + redirectUrl); // TEST DE FUERZA BRUTA
      window.location.href =
        window.location.origin + window.location.pathname + redirectUrl;
      break; */
    case "success":
      Swal.fire({
        icon: "success",
        title: "¡Éxito!",
        text: message,
      }).then(() => {
        if (redirectUrl) {
          window.location.href = redirectUrl;
        }
      });
      break;

    case "error":
      Swal.fire("Error", message, "error");
      break;

    default:
      Swal.fire("Aviso", message, "info");
  }
};
