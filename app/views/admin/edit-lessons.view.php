<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/app.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9 col-xl-8">

            <div class="card shadow-sm border-0 p-2 p-md-4">

                <!-- HEADER -->
                <div class="card-header bg-white border-0 text-center py-4">

                    <h2 class="mb-0">
                        Editar Clase
                    </h2>

                    <small class="text-muted">
                        Modificá los datos de la clase
                    </small>

                </div>

                <!-- BODY -->
                <div class="card-body p-3 p-md-4">

                    <form method="POST"
                          action="?url=admin&section=update-lesson">

                        <input type="hidden"
                               name="id"
                               value="<?= $lesson['id'] ?>">

                        <div class="row g-4">

                            <!-- Nivel -->
                            <div class="col-md-6">
                                <label class="form-label">Nivel</label>

                                <select name="level"
                                        class="form-select form-control-lg"
                                        required>

                                    <option value="Inicial"
                                        <?= $lesson['level'] == 'Inicial' ? 'selected' : '' ?>>
                                        Inicial
                                    </option>

                                    <option value="Intermedio"
                                        <?= $lesson['level'] == 'Intermedio' ? 'selected' : '' ?>>
                                        Intermedio
                                    </option>

                                    <option value="Experto"
                                        <?= $lesson['level'] == 'Experto' ? 'selected' : '' ?>>
                                        Experto
                                    </option>

                                </select>
                            </div>

                            <!-- Día -->
                            <div class="col-md-6">
                                <label class="form-label">Día</label>

                                <select name="day_of_week"
                                        class="form-select form-control-lg"
                                        required>
                                <option value="Monday" <?= $lesson['day_of_week']=='Monday'?'selected':'' ?>>Lunes</option>
                                <option value="Tuesday" <?= $lesson['day_of_week']=='Tuesday'?'selected':'' ?>>Martes</option>
                                <option value="Wednesday" <?= $lesson['day_of_week']=='Wednesday'?'selected':'' ?>>Miércoles</option>
                                <option value="Thursday" <?= $lesson['day_of_week']=='Thursday'?'selected':'' ?>>Jueves</option>
                                <option value="Friday" <?= $lesson['day_of_week']=='Friday'?'selected':'' ?>>Viernes</option>
                                <option value="Saturday" <?= $lesson['day_of_week']=='Saturday'?'selected':'' ?>>Sábado</option>

                                </select>
                            </div>

                            <!-- Entrenador -->
                            <div class="col-md-6">
                                <label class="form-label">Entrenador</label>

                                <select name="profile_id"
                                        class="form-select form-control-lg"
                                        required>

                                    <?php foreach ($coaches as $coach): ?>
                                        <option value="<?= $coach['profile_id'] ?>"
                                            <?= $coach['profile_id'] == $lesson['profile_id'] ? 'selected' : '' ?>>
                                            <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <!-- Hora inicio -->
                            <div class="col-md-6">
                                <label class="form-label">Hora inicio</label>

                                <input type="time"
                                       name="start_time"
                                       class="form-control form-control-lg"
                                       value="<?= $lesson['start_time'] ?>"
                                       required>
                            </div>

                            <!-- Hora fin -->
                            <div class="col-md-6">
                                <label class="form-label">Hora fin</label>

                                <input type="time"
                                       name="end_time"
                                       class="form-control form-control-lg"
                                       value="<?= $lesson['end_time'] ?>"
                                       required>
                            </div>

                            <!-- Capacidad -->
                            <div class="col-md-6">
                                <label class="form-label">Capacidad</label>

                                <input type="number"
                                       name="capacity"
                                       class="form-control form-control-lg"
                                       value="<?= $lesson['capacity'] ?>"
                                       required>
                            </div>

                            <!-- BOTÓN -->
                            <div class="col-12 text-center mt-3">

                                <button type="submit"
                                        class="btn btn-primary-admin px-5 py-3"
                                        style="border-radius:12px; min-width:260px;">
                                    Guardar cambios
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>