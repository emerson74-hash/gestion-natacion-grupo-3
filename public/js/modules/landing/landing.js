/**
 * ─────────────────────────────────────────────────────────────
 * ARCHIVO: public/js/landing.js
 * ─────────────────────────────────────────────────────────────
 * JavaScript exclusivo de la landing page de Swim Learn.
 * · NO interfiere con authMain.js ni ningún otro JS del proyecto.
 * · Se carga al final del <body> de landing.view.php
 * · Módulos incluidos:
 *     1. initNavbar()       → navbar transparente → sólida al scroll
 *     2. initHamburger()    → menú mobile toggle
 *     3. initSmoothLinks()  → cierra el menú mobile al hacer click en un link
 *     4. initCounters()     → anima los números de la sección Stats
 *     5. initReveal()       → animación de entrada de elementos al hacer scroll
 *     6. initContactForm()  → validación y feedback del formulario de contacto
 * ─────────────────────────────────────────────────────────────
 */

'use strict';

/* ══════════════════════════════════════════════════════════════
   1. NAVBAR — Transparente → Sólida al hacer scroll
   · Escucha el evento scroll en window
   · Agrega/quita la clase CSS .sl-navbar--solid al <nav>
   · El estilo de esa clase está definido en landing.css
══════════════════════════════════════════════════════════════ */
function initNavbar() {
  const navbar = document.getElementById('slNavbar');
  if (!navbar) return;

  const SCROLL_THRESHOLD = 60; // px desde el top para activar el cambio

  function onScroll() {
    if (window.scrollY > SCROLL_THRESHOLD) {
      navbar.classList.add('sl-navbar--solid');
    } else {
      navbar.classList.remove('sl-navbar--solid');
    }
  }

  // Escucha pasiva para no bloquear el scroll del navegador
  window.addEventListener('scroll', onScroll, { passive: true });

  // Ejecutar una vez al cargar por si la página ya está scrolleada
  onScroll();
}


/* ══════════════════════════════════════════════════════════════
   2. HAMBURGUESA — Menú mobile toggle
   · Agrega/quita .sl-nav-open en la lista de links
   · Agrega/quita .sl-is-open en el botón (anima las 3 barras → X)
   · La navbar se vuelve sólida automáticamente cuando el menú está abierto
══════════════════════════════════════════════════════════════ */
function initHamburger() {
  const btn   = document.getElementById('slHamburger');
  const links = document.getElementById('slNavLinks');
  const navbar = document.getElementById('slNavbar');
  if (!btn || !links) return;

  btn.addEventListener('click', () => {
    const isOpen = links.classList.toggle('sl-nav-open');
    btn.classList.toggle('sl-is-open', isOpen);

    // Forzar fondo sólido mientras el menú esté abierto
    if (isOpen) {
      navbar.classList.add('sl-navbar--solid');
    } else if (window.scrollY <= 60) {
      navbar.classList.remove('sl-navbar--solid');
    }
  });
}


/* ══════════════════════════════════════════════════════════════
   3. SMOOTH LINKS — Cierra el menú mobile al navegar
   · Cuando el usuario toca un link del menú mobile,
     cierra el menú para que pueda ver la sección destino
══════════════════════════════════════════════════════════════ */
function initSmoothLinks() {
  const links  = document.getElementById('slNavLinks');
  const btn    = document.getElementById('slHamburger');
  const navbar = document.getElementById('slNavbar');
  if (!links) return;

  links.querySelectorAll('.sl-nav-link').forEach(link => {
    link.addEventListener('click', () => {
      // Cerrar menú mobile si está abierto
      links.classList.remove('sl-nav-open');
      btn && btn.classList.remove('sl-is-open');
      if (window.scrollY <= 60) {
        navbar && navbar.classList.remove('sl-navbar--solid');
      }
    });
  });
}


/* ══════════════════════════════════════════════════════════════
   4. COUNTERS — Anima los números de la sección Stats
   · Usa IntersectionObserver para detectar cuando la sección
     entra en el viewport y lanza la animación solo una vez
   · Los elementos deben tener el atributo data-target="[número]"
     y la clase .sl-stat-number
══════════════════════════════════════════════════════════════ */
function initCounters() {
  const counters = document.querySelectorAll('.sl-stat-number');
  if (!counters.length) return;

  /**
   * Anima un número de 0 hasta su valor destino
   * @param {HTMLElement} el       - El span que contiene el número
   * @param {number}      target   - El valor final
   * @param {number}      duration - Duración de la animación en ms
   */
  function animateCount(el, target, duration = 1800) {
    const start     = performance.now();
    const startVal  = 0;

    function step(now) {
      const elapsed  = now - start;
      const progress = Math.min(elapsed / duration, 1);
      // Easing: ease-out (más rápido al inicio, más lento al final)
      const ease     = 1 - Math.pow(1 - progress, 3);
      const current  = Math.round(startVal + (target - startVal) * ease);
      el.textContent = current;
      if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
  }

  // Observador: lanza la animación cuando el elemento entra al 20% del viewport
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el     = entry.target;
          const target = parseInt(el.dataset.target, 10);
          if (!isNaN(target)) animateCount(el, target);
          observer.unobserve(el); // Animación solo una vez
        }
      });
    },
    { threshold: 0.2 }
  );

  counters.forEach(counter => observer.observe(counter));
}


/* ══════════════════════════════════════════════════════════════
   5. REVEAL — Animación de entrada al hacer scroll
   · Busca todos los elementos con clase .sl-reveal
   · Cuando entran en el viewport, les agrega .sl-visible
   · Los estilos de transición están en landing.css
══════════════════════════════════════════════════════════════ */
function initReveal() {
  const elements = document.querySelectorAll('.sl-reveal');
  if (!elements.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('sl-visible');
          observer.unobserve(entry.target); // Una sola vez
        }
      });
    },
    { threshold: 0.15 }
  );

  elements.forEach(el => observer.observe(el));
}

// Agrega la clase sl-reveal a los elementos que queremos animar
function addRevealClasses() {
  const targets = [
    '.sl-stat-card',       // tarjetas de stats
    '.sl-act-card',        // tarjetas de actividades
    '.sl-service-item',    // ítems de servicios
    '.sl-contact-item',    // datos de contacto
    '.sl-section-header',  // encabezados de sección
  ];

  targets.forEach(selector => {
    document.querySelectorAll(selector).forEach(el => {
      el.classList.add('sl-reveal');
    });
  });
}


/* ══════════════════════════════════════════════════════════════
   6. CONTACT FORM — Validación y feedback
   · Validación básica de nombre, email y mensaje
   · Muestra mensajes de éxito/error sin recargar la página
   · Para conectar con el backend PHP, reemplazá el bloque
     marcado "TODO: BACKEND" con un fetch() a tu endpoint
══════════════════════════════════════════════════════════════ */
function initContactForm() {
  const btn      = document.getElementById('btnContactSend');
  const feedback = document.getElementById('contactFeedback');
  if (!btn || !feedback) return;

  btn.addEventListener('click', () => {
    const name  = document.getElementById('contactName')?.value.trim();
    const email = document.getElementById('contactEmail')?.value.trim();
    const msg   = document.getElementById('contactMsg')?.value.trim();

    // Limpiar estado previo
    feedback.textContent = '';
    feedback.className   = 'sl-form-feedback';

    // ── Validaciones ──
    if (!name) {
      showFeedback('Por favor ingresá tu nombre.', 'error');
      return;
    }

    if (!email || !isValidEmail(email)) {
      showFeedback('Ingresá un email válido.', 'error');
      return;
    }

    if (!msg || msg.length < 10) {
      showFeedback('El mensaje debe tener al menos 10 caracteres.', 'error');
      return;
    }

    // ── TODO: BACKEND ──────────────────────────────────────────
    // Reemplazá este bloque con un fetch() a tu controlador PHP:
    //
    // fetch('?url=contact', {
    //   method: 'POST',
    //   headers: { 'Content-Type': 'application/json' },
    //   body: JSON.stringify({ name, email, message: msg })
    // })
    // .then(r => r.json())
    // .then(data => {
    //   if (data.success) showFeedback('¡Mensaje enviado!', 'ok');
    //   else showFeedback('Ocurrió un error. Intentá más tarde.', 'error');
    // })
    // .catch(() => showFeedback('Sin conexión. Intentá más tarde.', 'error'));
    // ───────────────────────────────────────────────────────────

    // Simulación de envío exitoso (eliminar cuando tengas el backend)
    btn.disabled    = true;
    btn.textContent = 'Enviando...';

    setTimeout(() => {
      showFeedback('¡Gracias! Nos ponemos en contacto pronto.', 'ok');
      document.getElementById('contactName').value  = '';
      document.getElementById('contactEmail').value = '';
      document.getElementById('contactMsg').value   = '';
      btn.disabled    = false;
      btn.innerHTML   = 'Enviar mensaje <i class="bi bi-send"></i>';
    }, 1200);
  });

  /**
   * Muestra un mensaje de feedback con estilo
   * @param {string} text  - Texto a mostrar
   * @param {'ok'|'error'} type - Tipo de mensaje
   */
  function showFeedback(text, type) {
    feedback.textContent = text;
    feedback.classList.add(`sl-form-feedback--${type}`);
  }

  /**
   * Valida el formato de un email con regex simple
   * @param {string} email
   * @returns {boolean}
   */
  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
}


/* ══════════════════════════════════════════════════════════════
   INIT PRINCIPAL
   · Se ejecuta cuando el DOM está completamente cargado
   · Inicializa todos los módulos en orden
══════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
  addRevealClasses();  // Primero agrega las clases para animaciones
  initNavbar();
  initHamburger();
  initSmoothLinks();
  initCounters();
  initReveal();
  initContactForm();
});
