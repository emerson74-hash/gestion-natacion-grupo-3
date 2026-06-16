<?php include __DIR__ . '/../users/layout/header.php'; ?>


<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4 class="mb-0">Mis clases</h4>

        <a href="?url=coach/dashboard"
           class="btn btn-sm btn-coach-back">
            Volver al panel
        </a>

    </div>
                <!-- TABLA DE CLASES -->
                <table class="table" id="swimmers_table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Horario</th>
                            <th>Nivel</th>
                            <th>Inscriptos</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($lessons as $lesson): ?>

                            <tr>
                                <?php
                            $days = [
                                'Monday' => 'Lunes',
                                'Tuesday' => 'Martes',
                                'Wednesday' => 'Miércoles',
                                'Thursday' => 'Jueves',
                                'Friday' => 'Viernes',
                                'Saturday' => 'Sábado',
                                'Sunday' => 'Domingo'
                            ];
                            ?>

                            <td>
    <?= $days[$lesson['day_of_week']] ?? $lesson['day_of_week'] ?>
</td>
                                <td><?= substr($lesson['start_time'], 0, 5) ?></td>
                                <td><?= $lesson['level'] ?></td>
                                <td><?= $lesson['booked_count'] ?></td>

                                <td>
                                    <button class="btn btn-sm btn-book btn-students" data-lesson-id="<?= $lesson['id'] ?>">
                                        Ver alumnos
                                    </button>
                                </td>
                            </tr>



                        <?php endforeach; ?>

                    </tbody>
                </table>
                <div class="modal fade" id="studentsModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Alumnos inscriptos</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>

                            <div class="modal-body" id="studentsContainer">

                                <div class="text-center">
                                    Cargando...
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>