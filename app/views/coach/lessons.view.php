<?php include __DIR__ . '/../users/layout/header.php'; ?>
<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

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
                                <td><?= $lesson['day_of_week'] ?></td>
                                <td><?= substr($lesson['start_time'], 0, 5) ?></td>
                                <td><?= $lesson['level'] ?></td>
                                <td><?= $lesson['booked_count'] ?></td>

                                <td>
                                    <button class="btn btn-sm btn-book btn-students"
                                        data-lesson-id="<?= $lesson['id'] ?>">
                                        Ver alumnos
                                    </button>
                                </td>
                            </tr>



                        <?php endforeach; ?>

                    </tbody>
                </table>
                <div class="modal fade" id="studentsModal" tabindex="-1">
                    <div class="modal-dialog">
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