import { handleAlert } from "../../services/ui.js";

export function initProfile() {

    console.log("formProfile cargado");

    const form = document.getElementById("profileForm");

    if (!form) {
        console.log("No se encontró profileForm");
        return;
    }

    console.log("Formulario encontrado");

    form.addEventListener("submit", async (e) => {

        e.preventDefault();

        console.log("submit interceptado");

        const formData = new FormData(form);

        try {

            const response = await fetch(form.action, {
                method: "POST",
                body: formData
            });

            const data = await response.json();

            handleAlert(
                data.status,
                data.message,
                data.redirect
            );

        } catch (error) {

            console.error(error);

            handleAlert(
                "error",
                "Error de conexión."
            );

        }
    });
}