'use strict';

function initNavbar() {
    const navbar = document.getElementById('slNavbar');
    if (!navbar) return;
    const SCROLL_THRESHOLD = 60;
    function onScroll() {
        if (window.scrollY > SCROLL_THRESHOLD) {
            navbar.classList.add('sl-navbar--solid');
        } else {
            navbar.classList.remove('sl-navbar--solid');
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

function initHamburger() {
    const btn    = document.getElementById('slHamburger');
    const links  = document.getElementById('slNavLinks');
    const navbar = document.getElementById('slNavbar');
    if (!btn || !links) return;
    btn.addEventListener('click', () => {
        const isOpen = links.classList.toggle('sl-nav-open');
        btn.classList.toggle('sl-is-open', isOpen);
        if (isOpen) {
            navbar.classList.add('sl-navbar--solid');
        } else if (window.scrollY <= 60) {
            navbar.classList.remove('sl-navbar--solid');
        }
    });
}

function initSmoothLinks() {
    const links  = document.getElementById('slNavLinks');
    const btn    = document.getElementById('slHamburger');
    const navbar = document.getElementById('slNavbar');
    if (!links) return;
    links.querySelectorAll('.sl-nav-link').forEach(link => {
        link.addEventListener('click', () => {
            links.classList.remove('sl-nav-open');
            btn && btn.classList.remove('sl-is-open');
            if (window.scrollY <= 60) {
                navbar && navbar.classList.remove('sl-navbar--solid');
            }
        });
    });
}

function initCounters() {
    const counters = document.querySelectorAll('.sl-stat-number');
    if (!counters.length) return;
    function animateCount(el, target, duration = 1800) {
        const start = performance.now();
        function step(now) {
            const elapsed  = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const ease     = 1 - Math.pow(1 - progress, 3);
            el.textContent = Math.round(target * ease);
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target, 10);
                if (!isNaN(target)) animateCount(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    counters.forEach(counter => observer.observe(counter));
}

function initReveal() {
    const elements = document.querySelectorAll('.sl-reveal');
    if (!elements.length) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('sl-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    elements.forEach(el => observer.observe(el));
}

function addRevealClasses() {
    const targets = [
        '.sl-stat-card',
        '.sl-act-card',
        '.sl-service-item',
        '.sl-contact-item',
        '.sl-section-header',
    ];
    targets.forEach(selector => {
        document.querySelectorAll(selector).forEach(el => {
            el.classList.add('sl-reveal');
        });
    });
}

function initContactForm() {
    const form = document.querySelector('.contact-form form');
    if (!form) return;

    // Crea el cartel de feedback dinámicamente, sin tocar el HTML
    let feedback = document.getElementById('contactFeedback');
    if (!feedback) {
        feedback = document.createElement('p');
        feedback.id = 'contactFeedback';
        feedback.style.marginTop = '10px';
        feedback.style.fontWeight = '600';
        form.appendChild(feedback);
    }

    function showFeedback(text, ok) {
        feedback.textContent = text;
        feedback.style.color = ok ? '#2ecc71' : '#e74c3c';
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const nombre  = form.querySelector('[name="nombre"]')?.value.trim();
        const email   = form.querySelector('[name="email"]')?.value.trim();
        const motivo  = form.querySelector('[name="motivo"]')?.value.trim() ?? '';
        const mensaje = form.querySelector('[name="mensaje"]')?.value.trim();

        feedback.textContent = '';

        if (!nombre)  { showFeedback('Por favor ingresá tu nombre.', false); return; }
        if (!email || !isValidEmail(email)) { showFeedback('Ingresá un email válido.', false); return; }
        if (!mensaje || mensaje.length < 10) { showFeedback('El mensaje debe tener al menos 10 caracteres.', false); return; }

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn ? submitBtn.textContent : '';
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Enviando...';
        }

        try {
            const formData = new FormData(form);
            const response = await fetch(form.action, { method: 'POST', body: formData });

            let ok = response.ok;
            let message = null;

            // Si el backend devuelve JSON, lo usamos. Si no, nos quedamos con el status HTTP.
            try {
                const data = await response.json();
                if (typeof data.success !== 'undefined') ok = data.success;
                if (data.message) message = data.message;
            } catch (_) { /* el backend no devolvió JSON, no pasa nada */ }

            if (ok) {
                showFeedback(message || '¡Mensaje enviado! Te contactaremos a la brevedad.', true);
                form.reset();
            } else {
                showFeedback(message || 'Ocurrió un error al enviar el mensaje. Intentá de nuevo.', false);
            }
        } catch (err) {
            console.error('Error al enviar el formulario:', err);
            showFeedback('No se pudo enviar. Revisá tu conexión e intentá más tarde.', false);
        } finally {
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        }
    });
}