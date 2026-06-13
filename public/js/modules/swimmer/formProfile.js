import { handleAlert } from "../../services/ui.js";

export function initSwimmerProfile() {

    const form = document.getElementById("profile-form");
    if (!form) return;

    const fileInput  = document.getElementById("profile_image");
    const previewImg = document.getElementById("crop-preview");

    //Ojito contraseña 
    document.getElementById("toggle-password")?.addEventListener("click", function () {
        const input = document.getElementById("password");
        const icon  = document.getElementById("eye-icon");
        const show  = input.type === "password";
        input.type  = show ? "text" : "password";
        icon.className = show ? "bi bi-eye-slash" : "bi bi-eye";
    });

    document.getElementById("toggle-confirm")?.addEventListener("click", function () {
        const input = document.getElementById("confirm_password");
        const icon  = document.getElementById("eye-icon-confirm");
        const show  = input.type === "password";
        input.type  = show ? "text" : "password";
        icon.className = show ? "bi bi-eye-slash" : "bi bi-eye";
    });

    // Vista previa imagen 
    fileInput?.addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    if (!allowedTypes.includes(file.type)) {
        handleAlert("error", "Solo se permiten imágenes JPG, PNG o GIF.");
        this.value = "";
        return;
    }

    if (file.size > 2 * 1024 * 1024) {
        handleAlert("warning", "La imagen no puede superar los 2MB.");
        this.value = "";
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        if (previewImg) {
            previewImg.src = e.target.result;
            previewImg.style.display = "block";

            // Destruir cropper anterior si existe
            if (window.cropperProfile && typeof window.cropperProfile.destroy === 'function') {
                window.cropperProfile.destroy();
            }

            // Inicializar CropperJS
            if (typeof Cropper !== 'undefined') {
                window.cropperProfile = new Cropper(previewImg, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 0.8
                });
            }
        }
    };
    reader.readAsDataURL(file);
});
    //Submit 
form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const firstNameInput = form.querySelector("#first_name");
    const lastNameInput  = form.querySelector("#last_name");
    const phoneInput     = form.querySelector("#phone");
    const birthInput     = form.querySelector("#birth_date");
    const passInput      = form.querySelector("#password");
    const confirmInput   = form.querySelector("#confirm_password");

    // Limpiar errores previos
    [firstNameInput, lastNameInput, phoneInput, birthInput, passInput, confirmInput]
        .forEach(i => i?.classList.remove("is-invalid"));

    if (!firstNameInput?.value.trim()) {
        firstNameInput?.classList.add("is-invalid");
        return handleAlert("warning", "El nombre es obligatorio.");
    }

    if (!lastNameInput?.value.trim()) {
        lastNameInput?.classList.add("is-invalid");
        return handleAlert("warning", "El apellido es obligatorio.");
    }

    if (!phoneInput?.value.trim()) {
        phoneInput?.classList.add("is-invalid");
        return handleAlert("warning", "El teléfono es obligatorio.");
    }

    if (birthInput?.value) {
        const birth   = new Date(birthInput.value);
        const today   = new Date();
        const minDate = new Date("1900-01-01");
        if (birth > today) {
            birthInput.classList.add("is-invalid");
            return handleAlert("warning", "La fecha no puede ser futura.");
        }
        if (birth < minDate) {
            birthInput.classList.add("is-invalid");
            return handleAlert("warning", "Ingresá una fecha válida.");
        }
    }

    if (passInput?.value.trim()) {
        if (passInput.value.length < 6) {
            passInput.classList.add("is-invalid");
            return handleAlert("warning", "La contraseña debe tener al menos 6 caracteres.");
        }
        if (passInput.value !== confirmInput?.value) {
            confirmInput?.classList.add("is-invalid");
            return handleAlert("warning", "Las contraseñas no coinciden.");
        }
    }

    const spinner = document.getElementById("save-spinner");
    const saveBtn = document.getElementById("save-btn");
    if (spinner) spinner.classList.remove("d-none");
    if (saveBtn) saveBtn.disabled = true;

        try {
            const formData = new FormData(form);

            // Integración con CropperJS
            if (window.cropperProfile) {
                const canvas = window.cropperProfile.getCroppedCanvas({ width: 300, height: 300 });
                const blob   = await new Promise((resolve) => canvas.toBlob(resolve, "image/jpeg", 0.9));
                formData.set("profile_image", blob, "avatar.jpg");
            }

            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
            });

            const text = await response.text();

            try {
                const data = JSON.parse(text);
                handleAlert(data.status, data.message, data.redirect);
            } catch {
                console.error("Respuesta del servidor:", text);
                handleAlert("error", "El servidor devolvió una respuesta inesperada.");
            }
        } catch (error) {
            console.error("Error:", error);
            handleAlert("error", "No se pudo conectar con el servidor.");
        } finally {
            if (spinner) spinner.classList.add("d-none");
            if (saveBtn) saveBtn.disabled = false;
        }
    });
}