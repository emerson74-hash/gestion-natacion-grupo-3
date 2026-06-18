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
               <i class="fas fa-arrow-left"></i>
                Volver al panel
        
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

                <!-- FILTRO POR DÍAS (ORDENADO) -->
                <div class="mb-4 d-flex flex-wrap gap-2" id="day-filter">

                    <button class="btn btn-sm btn-primary filter-btn active"
                            data-day="all">
                        Todos los días
                    </button>

                    <?php
                        $order = [
                            'Lunes',
                            'Martes',
                            'Miércoles',
                            'Jueves',
                            'Viernes',
                            'Sábado',
                            'Domingo'
                        ];

                        $days = array_unique(array_column($lessons, 'day_label'));

                        usort($days, function ($a, $b) use ($order) {
                            $posA = array_search($a, $order);
                            $posB = array_search($b, $order);
                            return $posA <=> $posB;
                        });
                    ?>

                    <?php foreach ($days as $day): ?>

                        <button class="btn btn-sm btn-outline-primary filter-btn"
                                data-day="<?= htmlspecialchars($day) ?>">

                            <?= htmlspecialchars($day) ?>

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
                        data-day="<?= htmlspecialchars($lesson['day_label']) ?>">

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
                                    <?= htmlspecialchars($lesson['level_label'] ?? $lesson['level']) ?>
                                </h5>

                                <p class="card-text mb-2">
                                    <?= htmlspecialchars($lesson['day_label'] ?? $lesson['day_of_week']) ?>
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

                                    <button class="btn btn-cancel w-100 booking-btn"
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

<?php include __DIR__ . '/../users/layout/footer.php'; ?>