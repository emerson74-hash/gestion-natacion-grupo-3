<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/app.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9 col-xl-8">

            <div class="card shadow-sm border-0 p-2 p-md-4">

                <!-- HEADER -->
                <div class="card-header text-center create-lesson-header">

                    <h2 class="mb-1">
                        Editar Clase
                    </h2>

                    <p class="mb-0">
                        Modificá los datos de la clase
                    </p>

                </div>

                <!-- BODY -->
                <div class="card-body p-3 p-md-4">

                    <form method="POST"
                          action="?url=admin&section=update-lesson">

                        <input type="hidden"
                               name="id"
                               value="<?= $lesson['id'] ?>">

                        <div class="row g-4">

                            <!-- Entrenador -->
                            <div class="col-md-6">
                                <label class="form-label">Entrenador</label>

                                <select name="profile_id"
                                        class="form-select form-control-lg admin-control"
                                        required>

                                    <?php foreach ($coaches as $coach): ?>
                                        <option value="<?= $coach['profile_id'] ?>"
                                            <?= $coach['profile_id'] == $lesson['profile_id'] ? 'selected' : '' ?>>
                                            <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <!-- Nivel -->
                            <div class="col-md-6">
                                <label class="form-label">Nivel</label>

                                <select name="level"
                                        class="form-select form-control-lg admin-control"
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
                                        class="form-select form-control-lg admin-control"
                                        required>
                                        <option value="1" <?= $lesson['day_of_week']==1?'selected':'' ?>>Lunes</option>
                                        <option value="2" <?= $lesson['day_of_week']==2?'selected':'' ?>>Martes</option>
                                        <option value="3" <?= $lesson['day_of_week']==3?'selected':'' ?>>Miércoles</option>
                                        <option value="4" <?= $lesson['day_of_week']==4?'selected':'' ?>>Jueves</option>
                                        <option value="5" <?= $lesson['day_of_week']==5?'selected':'' ?>>Viernes</option>
                                        <option value="6" <?= $lesson['day_of_week']==6?'selected':'' ?>>Sábado</option>
                            
                                </select>
                                </div>

                            <!-- Capacidad -->
                            <div class="col-md-6">
                                <label class="form-label">Capacidad</label>

                                <input type="number"
                                       name="capacity"
                                       class="form-control form-control-lg admin-control"
                                       value="<?= $lesson['capacity'] ?>"
                                       required>
                            </div>

                            <!-- Hora inicio -->
                            <div class="col-md-6">
                                <label class="form-label">Hora inicio</label>

                                <input type="time"
                                       name="start_time"
                                       class="form-control form-control-lg admin-control"
                                       value="<?= $lesson['start_time'] ?>"
                                       required>
                            </div>

                            <!-- Hora fin -->
                            <div class="col-md-6">
                                <label class="form-label">Hora fin</label>

                                <input type="time"
                                       name="end_time"
                                       class="form-control form-control-lg admin-control"
                                       value="<?= $lesson['end_time'] ?>"
                                       required>
                            </div>

                            <!-- BOTONES -->
                            <div class="col-12 text-center mt-4">

                                <div class="btn-container">

                                    <a href="?url=admin&section=lessons"
                                       class="btn-secondary-admin admin-btn">
                                        Cancelar
                                    </a>

                                    <button type="submit"
                                            class="btn-primary-admin admin-btn">
                                        Guardar cambios
                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>