import { initLogin } from "./auth/formLogin.js";
import { initRegister } from "./auth/formRegister.js";
import { initForgotPassword } from "./auth/formForgotPassword.js";
import { initResetPassword } from "./auth/formResetPassword.js";
import { initEdit } from "./coach/formEdit.js";
import { initLessonsTable } from "./coach/tableLessons.js";
import { initSwimmerProfile } from "./swimmer/formProfile.js";
import { initCoachesTable } from "./admin/tableCoaches.js";
import { initDeleteCoach } from "./admin/deleteCoach.js";


// Esperamos a que el DOM esté completamente cargado para evitar errores de referencia
document.addEventListener("DOMContentLoaded", () => {


    //initEdit();
    // Inicializamos cada funcionalidad. 
    // Cada módulo interno se encargará de verificar si su formulario existe en la vista actual.
   

    initLogin();
    initRegister();
    initForgotPassword();
    initResetPassword();

    // Funciones del coach
    initEdit();
    initLessonsTable();

    // Funciones del swimmer
    initSwimmerProfile();

    //funciones de admin
    initCoachesTable();
    initDeleteCoach();


    console.log("Auth module initialized successfully."); 
});