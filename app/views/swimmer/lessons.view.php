<?php include __DIR__ . '/../users/layout/header.php'; ?>


<div class="bg-white p-5 rounded shadow-sm">

    <!-- Encabezado de la pantalla -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="mb-1">Clases Disponibles</h1>

            <!-- Texto informativo -->
            <p class="text-muted mb-0">
                Inscribite en las clases que quieras. Podés cancelar cuando necesites.
            </p>
        </div>

        <!-- Botón para volver al dashboard -->
        <a href="<?= _URL ?>/?url=swimmer/dashboard"
           class="btn btn-outline-secondary">

            ← Volver al panel
        </a>

    </div>

    <hr>

    <!-- Acá mostramos mensajes de éxito o error -->
    <div id="lessons-alert" class="alert d-none" role="alert"></div>

    <?php if (empty($lessons)): ?>

        <!-- Si no hay clases -->
        <div class="alert alert-info">
            No hay clases disponibles por el momento.
        </div>

    <?php else: ?>

        <!-- ========================= -->
        <!-- FILTRO POR DÍA -->
        <!-- ========================= -->

        <div class="mb-4 d-flex flex-wrap gap-2" id="day-filter">

            <!-- Botón para mostrar todas -->
            <button class="btn btn-sm btn-primary filter-btn active"
                    data-day="all">

                Todos los días
            </button>

            <?php
                // Sacamos días repetidos
                $days = array_unique(array_column($lessons, 'day_of_week'));

                foreach ($days as $day):
            ?>

                <!-- Botones de filtro -->
                <button class="btn btn-sm btn-outline-primary filter-btn"
                        data-day="<?= htmlspecialchars($day) ?>">

                    <?= htmlspecialchars($dayLabels[$day] ?? $day) ?>

                </button>

            <?php endforeach; ?>

        </div>

        <!-- Contenedor de tarjetas -->
        <div class="row g-3" id="lessons-grid">

        <?php foreach ($lessons as $lesson):

            // Verifica si la clase ya está llena
            $isFull = $lesson['booked_count'] >= $lesson['capacity'];

            // Verifica si el usuario ya está inscripto
            $isBooked = (bool) $lesson['is_booked'];

            // Calcula lugares disponibles
            $spotsLeft = max(0, $lesson['capacity'] - $lesson['booked_count']);
        ?>

            <!-- Tarjeta de clase -->
            <div class="col-md-6 col-lg-4 lesson-card"
                 data-day="<?= htmlspecialchars($lesson['day_of_week']) ?>">

                <!-- Si está inscripto agregamos borde verde -->
                <div class="card h-100 <?= $isBooked ? 'border-success border-2' : '' ?>">

                    <!-- Parte superior de la tarjeta -->
                    <div class="card-header d-flex justify-content-between align-items-center py-2">

                        <!-- Estado de la clase -->
                        <span class="badge <?= $isBooked ? 'bg-success' : ($isFull ? 'bg-danger' : 'bg-primary') ?>">

                            <?= $isBooked ? '✓ Inscripto' : ($isFull ? 'Clase llena' : 'Disponible') ?>

                        </span>

                        <!-- Lugares disponibles -->
                        <small class="text-muted">

                            <?= $spotsLeft ?> lugar<?= $spotsLeft !== 1 ? 'es' : '' ?>
                            libre<?= $spotsLeft !== 1 ? 's' : '' ?>

                        </small>

                    </div>

                    <!-- Contenido principal -->
                    <div class="card-body">

                        <!-- Nivel -->
                        <h5 class="card-title">
                            <?= htmlspecialchars($lesson['level'] ?? 'Natación') ?>
                        </h5>

                        <!-- Día -->
                        <p class="card-text mb-1">

                            <span class="fw-semibold"></span>

                            <?= htmlspecialchars($dayLabels[$lesson['day_of_week']] ?? $lesson['day_of_week']) ?>

                        </p>

                        <!-- Horario -->
                        <p class="card-text mb-2">

                            <span class="fw-semibold"></span>

                            <?= htmlspecialchars(substr($lesson['start_time'], 0, 5)) ?>
                            –
                            <?= htmlspecialchars(substr($lesson['end_time'], 0, 5)) ?>

                        </p>

                        <!-- Profesor responsable -->
                        <div class="mt-3 p-2 bg-light rounded">

                            <small class="text-muted d-block"
                                   style="font-size:.7rem;">

                                Profesor a cargo
                            </small>

                            <span class="fw-semibold small">

                                👤 <?= htmlspecialchars($lesson['coach_name']) ?>

                            </span>

                            <!-- Especialidad del coach -->
                            <?php if (!empty($lesson['coach_specialty'])): ?>

                                <br>

                                <small class="text-muted">

                                    <?= htmlspecialchars($lesson['coach_specialty']) ?>

                                </small>

                            <?php endif; ?>

                        </div>

                    </div>

                    <!-- Botones -->
                    <div class="card-footer bg-transparent border-top-0 pb-3">

                        <?php if ($isBooked): ?>

                            <!-- Botón cancelar -->
                            <button class="btn btn-outline-danger btn-sm w-100 booking-btn"
                                    data-action="cancel"
                                    data-lesson-id="<?= (int) $lesson['id'] ?>">

                                Cancelar inscripción
                            </button>

                        <?php elseif ($isFull): ?>

                            <!-- Clase llena -->
                            <button class="btn btn-secondary btn-sm w-100" disabled>

                                Sin lugares disponibles
                            </button>

                        <?php else: ?>

                            <!-- Botón inscribirse -->
                            <button class="btn btn-primary btn-sm w-100 booking-btn"
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

<?php include __DIR__ . '/../users/layout/footer.php'; ?>