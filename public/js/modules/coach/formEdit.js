/**
 * Gestión del edicion de alumnos mediante AJAX.
 * Este módulo captura los datos del formulario, valida archivos en el cliente
 * y los envía al controlador mediante la API Fetch.
 */
import { handleAlert } from "../../services/ui.js";

export function initRegister() {
  const form = document.getElementById("formRegister");
  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    // =========================
    // INPUTS
    // =========================
    const nombre = form.querySelector("input[name='nombre']");
    const apellido = form.querySelector("input[name='apellido']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");
    const confirm = form.querySelector("input[name='passwordconfirm']");

    // limpiar errores visuales
    [nombre, apellido, email, password, confirm].forEach((i) =>
      i.classList.remove("is-invalid")
    );

    // =========================
    // VALIDACIONES
    // =========================

    if (!nombre.value.trim()) {
      nombre.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su nombre.");
    }

    if (!apellido.value.trim()) {
      apellido.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su apellido.");
    }

    if (!email.value.trim()) {
      email.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su correo.");
    }

    if (!validarEmail(email.value)) {
      email.classList.add("is-invalid");
      return handleAlert("warning", "Correo inválido.");
    }

    if (!password.value.trim()) {
      password.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese una contraseña.");
    }

    if (password.value.length < 6) {
      password.classList.add("is-invalid");
      return handleAlert("warning", "La contraseña debe tener al menos 6 caracteres.");
    }

    if (password.value !== confirm.value) {
      confirm.classList.add("is-invalid");
      return handleAlert("warning", "Las contraseñas no coinciden.");
    }

    // =========================
    // ARCHIVO
    // =========================
    const fileInput = form.querySelector('input[name="profile_image"]');
    const file = fileInput ? fileInput.files[0] : null;

    if (file) {
      const allowedTypes = ["image/jpeg", "image/png", "image/gif"];

      if (!allowedTypes.includes(file.type)) {
        return handleAlert(
          "error",
          "Solo se permiten imágenes JPG, PNG o GIF."
        );
      }

      const maxSize = 2 * 1024 * 1024;
      if (file.size > maxSize) {
        return handleAlert(
          "warning",
          "La imagen no puede superar los 2MB."
        );
      }
    }

    // =========================
    // ENVÍO
    // =========================
    const formData = new FormData(form);
    if (window.cropper) {
      const canvas = window.cropper.getCroppedCanvas({
        width: 300,
        height: 300,
      });

      const blob = await new Promise(resolve =>
        canvas.toBlob(resolve, "image/jpeg", 0.9)
      );

      formData.set(
        "profile_image",
        blob,
        "avatar.jpg"
      );
    }


    try {
      const response = await fetch("?url=register", {
        method: "POST",
        body: formData,
      });

      const text = await response.text();

      try {
        const data = JSON.parse(text);
        handleAlert(data.status, data.message, data.redirect);
      } catch (err) {
        console.error("Respuesta inválida:", text);
        handleAlert("error", "Error del servidor.");
      }
    } catch (error) {
      console.error(error);
      handleAlert("error", "Error de conexión.");
    }
  });
}

// =========================
// UTIL
// =========================
function validarEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}