import { handleAlert } from "../../services/ui.js";

export function initSwimmerProfile() {
  const form = document.getElementById("profile-form");
  if (!form) return;

  const fileInput = document.getElementById("profile_image");
  const previewImg = document.getElementById("crop-preview");

  // Vista previa de imagen al seleccionar archivo
  if (fileInput) {
    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (!file) return;

      const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
      if (!allowedTypes.includes(file.type)) {
        handleAlert("error", "Solo se permiten imágenes JPG, PNG o GIF.");
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
        }
      };
      reader.readAsDataURL(file);
    });
  }

  // Envío del formulario por AJAX
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const phoneInput = form.querySelector("#phone");
    const phone = phoneInput ? phoneInput.value.trim() : "";

if (!phone) {
    if (phoneInput) phoneInput.classList.add("is-invalid");
    return handleAlert("warning", "El teléfono es obligatorio.");
}

if (phoneInput) phoneInput.classList.remove("is-invalid");

// Validación de fecha de nacimiento
const birthInput = form.querySelector("#birth_date");
if (birthInput && birthInput.value) {
    const birth = new Date(birthInput.value);
    const today = new Date();
    const minDate = new Date('1920-01-01');

    if (birth > today) {
        birthInput.classList.add("is-invalid");
        return handleAlert("warning", "La fecha de nacimiento no puede ser futura.");
    }

    if (birth < minDate) {
        birthInput.classList.add("is-invalid");
        return handleAlert("warning", "Ingresá una fecha de nacimiento válida.");
    }

    birthInput.classList.remove("is-invalid");
}
    const spinner = document.getElementById("save-spinner");
    const saveBtn = document.getElementById("save-btn");
    if (spinner) spinner.classList.remove("d-none");
    if (saveBtn) saveBtn.disabled = true;

    const formData = new FormData(form);

    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: formData,
      });

      const text = await response.text();

      try {
    const data = JSON.parse(text);
    handleAlert(data.status, data.message, data.redirect);
} catch (err) {
    console.error("Respuesta cruda del servidor:", text);  // esto te va a mostrar el error exacto
    handleAlert("error", "El servidor devolvió una respuesta inesperada.");
}
    } catch (error) {
      console.error("Error en la petición:", error);
      handleAlert("error", "No se pudo conectar con el servidor.");
    } finally {
      if (spinner) spinner.classList.add("d-none");
      if (saveBtn) saveBtn.disabled = false;
    }
  });
}