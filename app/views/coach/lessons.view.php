<?php include __DIR__ . '/../users/layout/header.php'; ?>
<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

                <!-- TABLA DE CLASES -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Hora</th>
                            <th>Nivel</th>
                            <th>Inscriptos</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($lessons as $lesson): ?>

                            <tr>
                                <td><?= $lesson['day_of_week'] ?></td>
                                <td><?= substr($lesson['start_time'], 0, 5) ?></td>
                                <td><?= $lesson['level'] ?></td>
                                <td><?= $lesson['booked_count'] ?></td>

                                <td>
                                    <a href="?url=coach/lessons&id=<?= $lesson['id'] ?>" class="btn btn-sm btn-primary">
                                        Ver alumnos
                                    </a>
                                </td>
                            </tr>

                            <?php if (!empty($selectedLessonId) && $selectedLessonId == $lesson['id']): ?>

                                <tr>
                                    <td colspan="5">

                                        <div class="mt-2 mb-2">
                                            <strong>Alumnos inscriptos</strong>
                                        </div>

                                        <?php if (!empty($students)): ?>

                                            <table class="table table-primary table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Apellido</th>
                                                        <th>Nombre</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php foreach ($students as $student): ?>
                                                        <tr>
                                                            <td><?= $student['first_name'] ?></td>
                                                            <td><?= $student['last_name'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                        <?php else: ?>

                                            <div class="alert alert-info mb-0">
                                                No hay inscriptos en esta clase.
                                            </div>

                                        <?php endif; ?>

                                    </td>
                                </tr>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>