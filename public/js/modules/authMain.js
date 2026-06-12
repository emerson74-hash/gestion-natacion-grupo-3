import { initLogin } from "./auth/formLogin.js";
import { initRegister } from "./auth/formRegister.js";
import { initForgotPassword } from "./auth/formForgotPassword.js";
import { initResetPassword } from "./auth/formResetPassword.js";

import { initEdit } from "./coach/formEdit.js";
import { initLessonsTable } from "./coach/tableLessons.js";

import { initSwimmerProfile } from "./swimmer/formProfile.js";

// Esperamos a que el DOM esté completamente cargado para evitar errores de referencia
document.addEventListener("DOMContentLoaded", () => {

    initLogin();
    initRegister();
    initForgotPassword();
    initResetPassword();

    // Funciones del coach
    initEdit();
    initLessonsTable();

    // Funciones del swimmer
    initSwimmerProfile();

    console.log("Auth module initialized successfully.");
});