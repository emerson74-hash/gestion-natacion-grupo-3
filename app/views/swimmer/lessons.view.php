<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">


<div class="container py-4">

    <div class="card shadow-sm mx-auto" style="max-width:1400px;">

        <div class="card-header py-3 position-relative">

            <a href="<?= _URL ?>/?url=swimmer/dashboard"
               class="btn btn-light btn-sm position-absolute"
               style="
                    left:20px;
                    top:50%;
                    transform:translateY(-50%);
                    border-radius:10px;
                    font-weight:600;
               ">
                ← Volver
            </a>

            <h2 class="mb-0 text-white fw-bold text-center">
                Clases Disponibles
            </h2>

        </div>

        <div class="card-body p-4">

            <p class="text-center text-muted mb-4">
                Inscribite en las clases que quieras. Podés cancelar cuando necesites.
            </p>

            <hr>

            <div id="lessons-alert" class="alert d-none" role="alert"></div>

            <?php if (empty($lessons)): ?>

                <div class="alert alert-info">
                    No hay clases disponibles por el momento.
                </div>

            <?php else: ?>

                <div class="mb-4 d-flex flex-wrap gap-2" id="day-filter">

                    <button class="btn btn-sm btn-primary filter-btn active"
                            data-day="all">
                        Todos los días
                    </button>

                    <?php
                        $days = array_unique(array_column($lessons, 'day_of_week'));

                        foreach ($days as $day):
                    ?>

                        <button class="btn btn-sm btn-outline-primary filter-btn"
                                data-day="<?= htmlspecialchars($day) ?>">

                            <?= htmlspecialchars($dayLabels[$day] ?? $day) ?>

                        </button>

                    <?php endforeach; ?>

                </div>

                <div class="row g-4" id="lessons-grid">

                <?php foreach ($lessons as $lesson):

                    $isFull = $lesson['booked_count'] >= $lesson['capacity'];
                    $isBooked = (bool) $lesson['is_booked'];
                    $spotsLeft = max(0, $lesson['capacity'] - $lesson['booked_count']);
                ?>

                    <div class="col-md-6 col-xl-4 lesson-card"
                         data-day="<?= htmlspecialchars($lesson['day_of_week']) ?>">

                        <div class="card h-100 lesson-modern-card">

                            <div class="card-header lesson-card-header d-flex justify-content-between align-items-center py-2">

                                <span class="badge <?= $isBooked ? 'bg-success' : ($isFull ? 'bg-danger' : 'bg-primary') ?>">

                                    <?= $isBooked ? '✓ Inscripto' : ($isFull ? 'Clase llena' : 'Disponible') ?>

                                </span>

                                <small class="text-muted">

                                    <?= $spotsLeft ?> lugar<?= $spotsLeft !== 1 ? 'es' : '' ?>
                                    libre<?= $spotsLeft !== 1 ? 's' : '' ?>

                                </small>

                            </div>

                            <div class="card-body">

                                <h5 class="card-title mb-3">
                                    <?= htmlspecialchars($lesson['level'] ?? 'Natación') ?>
                                </h5>

                                <p class="card-text mb-2">

                                    
                                    <?= htmlspecialchars($dayLabels[$lesson['day_of_week']] ?? $lesson['day_of_week']) ?>

                                </p>

                                <p class="card-text mb-3">

                                    
                                    <?= htmlspecialchars(substr($lesson['start_time'], 0, 5)) ?>
                                    -
                                    <?= htmlspecialchars(substr($lesson['end_time'], 0, 5)) ?>

                                </p>

                                <div class="lesson-coach-box">

                                    <small class="text-muted d-block">
                                        Profesor a cargo
                                    </small>

                                    <span class="fw-semibold">

                                         <?= htmlspecialchars($lesson['coach_name']) ?>

                                    </span>

                                    <?php if (!empty($lesson['coach_specialty'])): ?>

                                        <br>

                                        <small class="text-muted">

                                            <?= htmlspecialchars($lesson['coach_specialty']) ?>

                                        </small>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <div class="card-footer bg-transparent border-top-0 pb-3">

                                <?php if ($isBooked): ?>

                                <button class="btn btn-cancel w-100 booking-btn"
                                    data-action="cancel"
                                    data-lesson-id="<?= (int) $lesson['id'] ?>">

                                     Cancelar inscripción

                                </button>

                                <?php elseif ($isFull): ?>

                                    <button class="btn btn-outline-secondary w-100" disabled>

                                        Sin lugares disponibles

                                    </button>

                                <?php else: ?>

                                    <button class="btn btn-primary w-100 booking-btn"
                                            data-action="book"
                                            data-lesson-id="<?= (int) $lesson['id'] ?>">

                                        Inscribirme

                                    </button>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<script>
(function () {

    'use strict';

    // Caja donde mostramos mensajes
    const alertBox = document.getElementById('lessons-alert');

    // Contenedor de tarjetas
    const grid = document.getElementById('lessons-grid');

    // URLs para inscribirse o cancelar
    const urls = {
        book  : '<?= _URL ?>/?url=swimmer/book',
        cancel: '<?= _URL ?>/?url=swimmer/cancel-booking'
    };

    // =========================
    // ALERTAS
    // =========================

    // Muestra mensajes de éxito o error
    function showAlert(type, message) {

        const map = {
            success: 'success',
            warning: 'warning',
            error  : 'danger'
        };

        alertBox.className = 'alert alert-' + (map[type] ?? 'info');

        alertBox.textContent = message;

        // Mostramos la alerta
        alertBox.classList.remove('d-none');

        // Subimos arriba automáticamente
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

        // Si fue exitoso, ocultamos luego de 3 segundos
        if (type === 'success') {

            setTimeout(() => {
                alertBox.classList.add('d-none');
            }, 3000);
        }
    }

    // =========================
    // FILTRO POR DÍA
    // =========================

    document.getElementById('day-filter')?.addEventListener('click', function (e) {

        // Detectamos el botón presionado
        const btn = e.target.closest('.filter-btn');

        if (!btn) return;

        // Reseteamos estilos de todos los botones
        document.querySelectorAll('.filter-btn').forEach(b => {

            b.classList.remove('active', 'btn-primary');

            b.classList.add('btn-outline-primary');
        });

        // Marcamos el botón actual
        btn.classList.add('active', 'btn-primary');

        btn.classList.remove('btn-outline-primary');

        // Día seleccionado
        const day = btn.dataset.day;

        // Mostramos solo las clases de ese día
        document.querySelectorAll('.lesson-card').forEach(card => {

            card.style.display =
                (day === 'all' || card.dataset.day === day)
                    ? ''
                    : 'none';
        });
    });

    // =========================
    // INSCRIPCIÓN / CANCELACIÓN
    // =========================

    // Usamos AJAX para evitar recargar la página
    grid?.addEventListener('click', async function (e) {

        const btn = e.target.closest('.booking-btn');

        if (!btn) return;

        // Acción: book o cancel
        const action = btn.dataset.action;

        // ID de la clase
        const lessonId = btn.dataset.lessonId;

        // Guardamos el texto original
        const original = btn.textContent;

        // Bloqueamos el botón mientras procesa
        btn.disabled = true;

        btn.textContent = 'Procesando…';

        try {

            // Creamos datos para enviar
            const body = new FormData();

            body.append('lesson_id', lessonId);

            // Hacemos la petición
            const res = await fetch(urls[action], {
                method: 'POST',
                body
            });

            // Convertimos respuesta a JSON
            const data = await res.json();

            // Mostramos mensaje
            showAlert(data.status, data.message);

            // Si salió bien, recargamos la página
            if (data.status === 'success') {

                setTimeout(() => location.reload(), 1200);

            } else {

                // Restauramos botón
                btn.disabled = false;

                btn.textContent = original;
            }

        } catch {

            // Error de conexión
            showAlert('error', 'Error de conexión. Intentá de nuevo.');

            // Restauramos botón
            btn.disabled = false;

            btn.textContent = original;
        }
    });

})();
</script>

</div>
<?php include __DIR__ . '/../users/layout/footer.php'; ?>