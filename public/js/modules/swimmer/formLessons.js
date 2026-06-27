import { handleAlert } from "../../services/ui.js";

export function initSwimmerLessons() {

    const grid = document.getElementById('lessons-grid');
    if (!grid) return;

    const baseUrl = window.location.origin + '/gestion-natacion-grupo-3';

    const urls = {
        book  : baseUrl + '/?url=swimmer/book',
        cancel: baseUrl + '/?url=swimmer/cancel-booking'
    };

    const order = {
        Monday: 1,
        Tuesday: 2,
        Wednesday: 3,
        Thursday: 4,
        Friday: 5,
        Saturday: 6,
        Sunday: 7
    };

    function sortCards() {

        const cards = Array.from(document.querySelectorAll('.lesson-card'));

        cards.sort((a, b) => {
            return (order[a.dataset.day] ?? 999) - (order[b.dataset.day] ?? 999);
        });

        cards.forEach(card => grid.appendChild(card));
    }

function forceGlobalOrderLessons() {

    const grid = document.getElementById('lessons-grid');
    if (!grid) return;

    const order = {
        Monday: 1,
        Tuesday: 2,
        Wednesday: 3,
        Thursday: 4,
        Friday: 5,
        Saturday: 6,
        Sunday: 7,

        // español por si viene mezclado
        Lunes: 1,
        Martes: 2,
        Miercoles: 3,
        Miércoles: 3,
        Jueves: 4,
        Viernes: 5,
        Sabado: 6,
        Sábado: 6,
        Domingo: 7
    };

    const cards = Array.from(grid.querySelectorAll('.lesson-card'));

    cards.sort((a, b) => {
        return (order[a.dataset.day] ?? 999) - (order[b.dataset.day] ?? 999);
    });

    cards.forEach(card => grid.appendChild(card));
}

window.addEventListener('load', () => {
    setTimeout(forceGlobalOrderLessons, 50);
});





    // FILTRO POR DÍA

    function sortFilterButtons() {

    const container = document.getElementById('day-filter');
    if (!container) return;

const order = {
    all: 0,
    Lunes: 1,
    Martes: 2,
    Miercoles: 3,
    Miércoles: 3,
    Jueves: 4,
    Viernes: 5,
    Sabado: 6,
    Sábado: 6,
    Domingo: 7
};

    const buttons = Array.from(container.querySelectorAll('.filter-btn'));

    buttons.sort((a, b) => {
        return (order[a.dataset.day] ?? 999) - (order[b.dataset.day] ?? 999);
    });

    buttons.forEach(btn => container.appendChild(btn));
}
window.addEventListener('load', () => {
    setTimeout(() => {
        forceGlobalOrderLessons();
        sortFilterButtons();
    }, 50);
});


//FILTROS POR DIA
    document.getElementById('day-filter')?.addEventListener('click', function (e) {

        const btn = e.target.closest('.filter-btn');
        if (!btn) return;

        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.remove('active', 'btn-primary');
            b.classList.add('btn-outline-primary');
        });

        btn.classList.add('active', 'btn-primary');
        btn.classList.remove('btn-outline-primary');

        const day = btn.dataset.day;

        document.querySelectorAll('.lesson-card').forEach(card => {
            card.style.display = (day === 'all' || card.dataset.day === day) ? '' : 'none';
        });
    });

    // INSCRIPCIÓN / CANCELACIÓN
    grid?.addEventListener('click', async function (e) {

        const btn = e.target.closest('.booking-btn');
        if (!btn) return;

        const action   = btn.dataset.action;
        const lessonId = btn.dataset.lessonId;
        const original = btn.textContent.trim();

        btn.disabled = true;
        btn.textContent = 'Procesando…';

        try {
            const body = new FormData();
            body.append('lesson_id', lessonId);

            const res  = await fetch(urls[action], { method: 'POST', body });
            const data = await res.json();

            handleAlert(data.status, data.message);

            if (data.status === 'success') {
                setTimeout(() => location.reload(), 1500);
            } else {
                btn.disabled = false;
                btn.textContent = original;
            }

        } catch {
            handleAlert("error", "Error de conexión. Intentá de nuevo.");

            btn.disabled = false;
            btn.textContent = original;
        }
    });
}