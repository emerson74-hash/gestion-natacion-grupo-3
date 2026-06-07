import { handleAlert } from "../../services/ui.js";

export function initProfile() {

    console.log("formProfile cargado");

    const form = document.getElementById("profile-form");

    if (!form) {
        console.log("No se encontró profile-form");
        return;
    }

    console.log("Formulario encontrado");

    form.addEventListener("submit", async (e) => {

        e.preventDefault();

        const phone = form.querySelector("#phone");
        const birthDate = form.querySelector("#birth_date");
        const imageInput = form.querySelector("#profile_image");

        // =========================
        // LIMPIAR ERRORES
        // =========================

        [phone, birthDate].forEach(input => {
            if (input) {
                input.classList.remove("is-invalid");
            }
        });

        // =========================
        // TELÉFONO
        // =========================

        const phoneValue = phone.value.trim();

        if (!phoneValue) {

            phone.classList.add("is-invalid");

            return handleAlert(
                "warning",
                "Ingrese un teléfono."
            );
        }

        // Solo números, espacios, +, -, ()
        if (!/^[0-9+\-\s()]+$/.test(phoneValue)) {

            phone.classList.add("is-invalid");

            return handleAlert(
                "warning",
                "El teléfono contiene caracteres inválidos."
            );
        }

        // Contar solamente los números
        const digits = phoneValue.replace(/\D/g, "");

        if (digits.length < 8 || digits.length > 15) {

            phone.classList.add("is-invalid");

            return handleAlert(
                "warning",
                "El teléfono debe tener entre 8 y 15 dígitos."
            );
        }

        // =========================
        // FECHA DE NACIMIENTO
        // =========================

        if (birthDate.value) {

            const fecha = new Date(birthDate.value);
            const hoy = new Date();

            // No puede ser futura
            if (fecha > hoy) {

                birthDate.classList.add("is-invalid");

                return handleAlert(
                    "warning",
                    "La fecha de nacimiento no puede ser futura."
                );
            }

            // Edad mínima: 3 años
            const edad = hoy.getFullYear() - fecha.getFullYear();

            if (edad < 3) {

                birthDate.classList.add("is-invalid");

                return handleAlert(
                    "warning",
                    "Ingrese una fecha de nacimiento válida."
                );
            }

            // Edad máxima razonable
            if (edad > 120) {

                birthDate.classList.add("is-invalid");

                return handleAlert(
                    "warning",
                    "Ingrese una fecha de nacimiento válida."
                );
            }
        }

        // =========================
        // IMAGEN
        // =========================

        const file = imageInput.files[0];

        if (file) {

            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/gif"
            ];

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
                    "La imagen no puede superar los 2 MB."
                );
            }
        }

        // =========================
        // ENVÍO
        // =========================

        const formData = new FormData(form);

        try {

            const response = await fetch(
                "?url=swimmer/update-profile",
                {
                    method: "POST",
                    body: formData
                }
            );

            const text = await response.text();

            try {

                const data = JSON.parse(text);

                handleAlert(
                    data.status,
                    data.message,
                    data.redirect
                );

            } catch {

                console.error(text);

                handleAlert(
                    "error",
                    "Respuesta inválida del servidor."
                );
            }

        } catch (error) {

            console.error(error);

            handleAlert(
                "error",
                "Error de conexión."
            );
        }
    });
}