export function initPasswordToggles() {
  const init = () => {
    document.querySelectorAll("[data-toggle-password]").forEach(btn => {
      const targetId = btn.dataset.target;
      const input = document.getElementById(targetId);

      if (!input) return;

      let icon = btn.querySelector("i");

      if (!icon) {
        btn.innerHTML = `<i class="bi bi-eye"></i>`;
        icon = btn.querySelector("i");
      }

      btn.addEventListener("click", () => {
        const isHidden = input.type === "password";
        input.type = isHidden ? "text" : "password";

        icon.classList.toggle("bi-eye");
        icon.classList.toggle("bi-eye-slash");
      });
    });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
}