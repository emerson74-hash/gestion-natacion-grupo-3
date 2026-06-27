
import { handleAlert } from "../../services/ui.js";

export function initEdit() {
   //console.log("initEdit ejecutado");
  const form = document.getElementById("formEdit");
  if (!form) return; // Si no está el formulario en la página actual, frena la función de forma limpia

  const fileInput = document.getElementById("profile_image");
  const previewImg = document.getElementById("preview");
  const currentImg = document.getElementById("current_profile_image");

  // ==========================================
  // VISTA PREVIA DE LA IMAGEN EN TIEMPO REAL
  // ==========================================
  if (fileInput) {
    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      console.log("Cambio detectado");
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

            
            // Si ya había un cropper activo de una foto anterior, lo destruimos para no duplicarlo
            if (window.cropper && typeof window.cropper.destroy === 'function') {
              window.cropper.destroy();
            }

            // Inicializamos Cropper en la imagen de vista previa
            
            if (typeof Cropper !== 'undefined') {
              window.cropper = new Cropper(previewImg, {
                aspectRatio: 1, // estos 3 son parametros de cropper
                viewMode: 1,    
                autoCropArea: 0.8 
              });
              console.log(window.cropper);
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
    e.preventDefault();                                                       //frena el envio normal y permite a ajax tomar el controll


    const nombre = form.querySelector('[name="first_name"]');
      const apellido = form.querySelector('[name="last_name"]');
      const specialty = form.querySelector('[name="specialty"]');
      const phone = form.querySelector('[name="phone"]');
    const password = form.querySelector("#nueva_contraseña");
    const confirm = form.querySelector("#confirmar_nueva_contraseña");

    // Limpiar clases de error previas de Bootstrap de forma segura
    [nombre, apellido, specialty, password, confirm].forEach((input) => {
      if (input) input.classList.remove("is-invalid");
    });

    
    if (!nombre || !nombre.value.trim()) {
      if (nombre) nombre.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su nombre.");
    }

    if (!apellido || !apellido.value.trim()) {
      if (apellido) apellido.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su apellido.");
    }

    if (!specialty || !specialty.value.trim()) {
      if (specialty) specialty.classList.add("is-invalid");
      return handleAlert("warning", "Ingrese su especialidad.");
    }
if (!phone || !phone.value.trim()) {
  phone.classList.add("is-invalid");
  return handleAlert("warning", "Ingrese su teléfono.");
}

const phoneClean = phone.value.replace(/\D/g, "");

if (phoneClean.length < 8 || phoneClean.length > 15) {
  phone.classList.add("is-invalid");
  return handleAlert("warning", "El teléfono debe tener entre 8 y 15 dígitos.");
}
    
    if (password && password.value.trim() !== "") {
      if (password.value.length < 6) {
        password.classList.add("is-invalid");
        return handleAlert("warning", "La contraseña debe tener al menos 6 caracteres.");
      }

      if (!confirm || password.value !== confirm.value) {
        if (confirm) confirm.classList.add("is-invalid");
        return handleAlert("warning", "Las contraseñas no coinciden.");
      }
    }

    const formData = new FormData(form);

    // Integración opcional con Cropper
    if (window.cropper) {
      const canvas = window.cropper.getCroppedCanvas({ width: 300, height: 300 });
      const blob = await new Promise((resolve) => canvas.toBlob(resolve, "image/jpeg", 0.9));
      formData.set("profile_image", blob, "avatar.jpg");
    }

    try {
      const response = await fetch("?url=coach/updateProfile", {
        method: "POST",
        body: formData,
      });

      const text = await response.text();

      try {
        const data = JSON.parse(text);
        handleAlert(data.status, data.message, data.redirect);
      } catch (err) {
        console.error("Respuesta cruda del servidor:", text);
        handleAlert("error", "El servidor devolvió una respuesta ilegible.");
      }
    } catch (error) {
      console.error("Error en la petición Fetch:", error);
      handleAlert("error", "No se pudo establecer conexión con el servidor.");
    }
  });
}