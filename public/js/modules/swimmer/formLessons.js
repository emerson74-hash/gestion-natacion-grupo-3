import { handleAlert } from "../../services/ui.js";

export function initSwimmerLessons() {

    const grid = document.getElementById('lessons-grid');
    if (!grid) return;

    const baseUrl = window.location.origin + '/gestion-natacion-grupo-3';

    const urls = {
        book  : baseUrl + '/?url=swimmer/book',
        cancel: baseUrl + '/?url=swimmer/cancel-booking'
    };

    // Filtro por día
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

    // Inscripción / Cancelación
    grid?.addEventListener('click', async function (e) {
        const btn = e.target.closest('.booking-btn');
        if (!btn) return;

        const action   = btn.dataset.action;
        const lessonId = btn.dataset.lessonId;
        const original = btn.textContent.trim();

        btn.disabled    = true;
        btn.textContent = 'Procesando…';

        try {
            const body = new FormData();
            body.append('lesson_id', lessonId);

            const res  = await fetch(urls[action], { method: 'POST', body });
            const data = await res.json();

            // 🔥 reemplazo único
            handleAlert(data.status, data.message);

            if (data.status === 'success') {
                setTimeout(() => {
                    location.reload();
                }, 1500);
            }

            if (data.status !== 'success') {
                btn.disabled    = false;
                btn.textContent = original;
            }

        } catch {
            handleAlert("error", "Error de conexión. Intentá de nuevo.");

            btn.disabled    = false;
            btn.textContent = original;
        }
    });
}