/*CODIGO REUTILIZABLE PARA MOSTRAR / OCULTAR PASSWORD */
export function initPasswordToggles() {
  const init = () => {
    document.querySelectorAll("[data-toggle-password]").forEach(btn => {
      const targetId = btn.dataset.target;
      const input = document.getElementById(targetId);

      if (!input) return;

      btn.addEventListener("click", () => {
       /* input.type = input.type === "password" ? "text" : "password";

        const icon = btn.querySelector("i");
        if (icon) {
          icon.classList.toggle("bi-eye");
          icon.classList.toggle("bi-eye-slash");*/


           const all = document.querySelectorAll("#password");

  console.log("PASSWORD INPUTS:", all.length);
  console.log(all);

  const input = all[0];

  console.log("ANTES:", input.type);

  input.type = input.type === "password" ? "text" : "password";

  console.log("DESPUÉS:", input.type);

        }
      );
    
    }
)}

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
}