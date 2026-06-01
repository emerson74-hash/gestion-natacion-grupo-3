/**
 * Gestiona el inicio de sesión mediante AJAX.
 * Implementa una técnica de captura de errores robusta para detectar fallos en PHP.
 */
import { handleAlert } from "../../services/ui.js";


export function initLogin() {
    const form = document.getElementById("formLogin");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = form.querySelector("input[name='email']");
        const password = form.querySelector("input[name='password']");

        // RESET estilos
        email.classList.remove("is-invalid");
        password.classList.remove("is-invalid");

        // VALIDACIONES FRONT
        if (!email.value.trim()) {
            email.classList.add("is-invalid");
            return handleAlert("warning", "Ingrese su correo electrónico.");
        }

        if (!validarEmail(email.value)) {
            email.classList.add("is-invalid");
            return handleAlert("warning", "Ingrese un correo válido.");
        }

        if (!password.value.trim()) {
            password.classList.add("is-invalid");
            return handleAlert("warning", "Ingrese su contraseña.");
        }

        if (password.value.length < 6) {
            password.classList.add("is-invalid");
            return handleAlert("warning", "La contraseña debe tener al menos 6 caracteres.");
        }

        const formData = new FormData(form);

        try {
            const response = await fetch("?url=authenticate", {
                method: "POST",
                body: formData,
            });

            const text = await response.text();
            const data = JSON.parse(text);

            handleAlert(data.status, data.message, data.redirect);

        } catch (error) {
            handleAlert("error", "Error de conexión con el servidor.");
        }
    });
}

function validarEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}