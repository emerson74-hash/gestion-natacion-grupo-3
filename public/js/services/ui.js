/**
 * Servicio de Interfaz de Usuario
 * Centraliza SweetAlert2 con estilo personalizado del sistema
 */

export const handleAlert = (status, message, redirectUrl = null) => {

  switch (status) {

    case "user_exists":
      Swal.fire({
        icon: "info",
        title: "Usuario registrado",
        text: message,
        confirmButtonText: "Ir al login",
        confirmButtonColor: "#4FD1E8",
        allowOutsideClick: false
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "http://localhost/gestion-natacion/?url=login";
        }
      });
      break;

    case "success":
      Swal.fire({
        icon: "success",
        title: "Operación exitosa",
        text: message,
        confirmButtonText: "Continuar",
        confirmButtonColor: "#4FD1E8",
        background: "#ffffff",
        color: "#1d1d1d",
        iconColor: "#4FD1E8",
        customClass: {
          popup: "swal-turquesa"
        }
      }).then(() => {
        if (redirectUrl) {
          window.location.href = redirectUrl;
        }
      });
      break;

    case "error":
      Swal.fire({
        icon: "error",
        title: "Error del sistema",
        text: message,
        confirmButtonColor: "#4FD1E8",
        background: "#ffffff",
        color: "#1d1d1d",
        iconColor: "#ff5c5c"
      });
      break;

    case "warning":
      Swal.fire({
        icon: "warning",
        title: "Atención",
        text: message,
        confirmButtonColor: "#4FD1E8",
        background: "#ffffff",
        color: "#1d1d1d",
        iconColor: "#f5a623"
      });
      break;

    default:
      Swal.fire({
        icon: "info",
        title: "Información",
        text: message,
        confirmButtonColor: "#4FD1E8"
      });
      break;
  }
};