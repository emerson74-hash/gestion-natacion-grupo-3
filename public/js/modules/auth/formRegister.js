/**
 * Gestión del alta de alumnos mediante AJAX con Cropper.js.
 * Este módulo captura los datos del formulario, valida archivos en el cliente
 * y los envía al controlador mediante la API Fetch.
 */
import { handleAlert } from "../../services/ui.js";
 
/*OJO */
import { initPasswordToggles } from "../passwordToggle.js";

//console.log("olaa")
export function initRegister() {
  const form = document.getElementById("formRegister");
  if (!form) return;

  const fileInput = document.getElementById("profile_image");
  const previewImg = document.getElementById("preview");
  const currentImg = document.getElementById("current_profile_image");

  // ==========================================
  // VISTA PREVIA DE LA IMAGEN EN TIEMPO REAL (CROPPER)
  // ==========================================
  if (fileInput) {
    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      
      if (file) {
        const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
        if (!allowedTypes.includes(file.type)) {
          handleAlert("error", "Solo se permiten imágenes JPG, PNG, WEBP o GIF.");
          this.value = "";
          return;
        }

        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
          handleAlert("warning", "La imagen no puede superar los 2MB.");
          this.value = "";
          return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
          if (previewImg) {
            previewImg.src = e.target.result;
            previewImg.style.display = "block";

            // Si ya había un cropper activo, lo destruimos para no duplicarlo
            if (window.cropper && typeof window.cropper.destroy === 'function') {
              window.cropper.destroy();
            }

            // Inicializamos Cropper en la imagen de vista previa
            if (typeof Cropper !== 'undefined') {
              window.cropper = new Cropper(previewImg, {
                aspectRatio: 1, 
                viewMode: 1,    
                autoCropArea: 0.8 
              });
            } else {
              console.error("Error: La librería Cropper.js no está cargada en el navegador.");
            }
          }
          if (currentImg) currentImg.style.opacity = "0.4";
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // ==========================================
  // EVENTO DE ENVÍO DE FORMULARIO (SUBMIT)
  // ==========================================
  form.addEventListener("submit", async (e) => {
    console.log("SUBMIT EJECUTADO");
    e.preventDefault();

    // =========================
    // INPUTS
    // =========================
    const nombre = form.querySelector("input[name='nombre']");
    const apellido = form.querySelector("input[name='apellido']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");
    const confirm = form.querySelector("input[name='passwordconfirm']");

    // Limpiar errores visuales de forma segura
    [nombre, apellido, email, password, confirm].forEach((i) => {
      if (i) i.classList.remove("is-invalid");
    });

    // =========================
    // VALIDACIONES
    // =========================
    if (!nombre || !nombre.value.trim()) {
      if (nombre) nombre.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su nombre.");
    }

    if (!apellido || !apellido.value.trim()) {
      if (apellido) apellido.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su apellido.");
    }

    if (!email || !email.value.trim()) {
      if (email) email.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su correo.");
    }

    if (!validarEmail(email.value)) {
      if (email) email.classList.add("is-invalid");
      return handleAlert("warning", "Correo inválido.");
    }

    if (!password || !password.value.trim()) {
      if (password) password.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese una contraseña.");
    }

    if (password.value.length < 6) {
      if (password) password.classList.add("is-invalid");
      return handleAlert("warning", "La contraseña debe tener al menos 6 caracteres.");
    }

    if (!confirm || password.value !== confirm.value) {
      if (confirm) confirm.classList.add("is-invalid");
      return handleAlert("warning", "Las contraseñas no coinciden.");
    }

    // =========================
    // ARCHIVO (Validación previa al envío)
    // =========================
    const file = fileInput ? fileInput.files[0] : null;
    if (file) {
      const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];
      if (!allowedTypes.includes(file.type)) {
        return handleAlert("error", "Solo se permiten imágenes JPG, PNG, WEBP o GIF.");
      }

      const maxSize = 2 * 1024 * 1024;
      if (file.size > maxSize) {
        return handleAlert("warning", "La imagen no puede superar los 2MB.");
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

      formData.set("profile_image", blob, "avatar.jpg");
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
        handleAlert("error", "Error del servidor al procesar la respuesta.");
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