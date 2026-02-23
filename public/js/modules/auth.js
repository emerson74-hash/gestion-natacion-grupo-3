

import { handleAlert } from '../services/ui.js'; // Asegúrate que esta ruta sea real físicamente

 const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(registerForm);

        try {
            const response = await fetch('?url=register', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            // La magia ocurre aquí, handleAlert ya sabe qué hacer con data.status
            handleAlert(data.status, data.message, data.redirect);

        } catch (error) {
            handleAlert('error', 'No se pudo conectar con el servidor.');
        }
    });
}
 

/* document.getElementById('registerForm').onsubmit = async function(e) {
    e.preventDefault();
    console.log("Enviando...");
    
    try {
        const res = await fetch('?url=register', { method: 'POST', body: new FormData(this) });
        const text = await res.text(); // Leemos como texto primero para ver errores
        console.log("Respuesta cruda del servidor:", text);
        
        const data = JSON.parse(text);
        alert(data.message); // Alerta nativa, no falla
        if(data.redirect) window.location.href = data.redirect;
    } catch (err) {
        console.error("Error fatal:", err);
    }
}; */
// ... (mantené lo de registerForm que ya tenés) ...

const loginForm = document.getElementById('loginForm');

if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(loginForm);

        try {
            const response = await fetch('?url=auth', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            // Si el login es exitoso, data.redirect debería ser '?url=home' o '?url=panel-alumno'
            handleAlert(data.status, data.message, data.redirect);
        } catch (error) {
            handleAlert('error', 'Error al intentar iniciar sesión.');
        }
    });
}