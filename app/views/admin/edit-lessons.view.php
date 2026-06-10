<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-12 col-xl-10">

            <div class="card p-4">

<<<<<<< HEAD
                <h1 class="text-center mb-4">
                  Editar Clase
                </h1>
=======
                <h2 class="text-center mb-4">
                    Editar Clase
                </h2>
>>>>>>> 1807713 (Mejoras formularios admin)

                <form method="POST"
                      action="?url=admin&section=update-lesson">

<<<<<<< HEAD
            <input type="hidden"
             name="id"
             value="<?= $lesson['id'] ?>">

            <div class="row">
            <div class="col-md- 6 mb-3">
            <label>Nivel</label>
=======
                    <input type="hidden"
                           name="id"
                           value="<?= $lesson['id'] ?>">

                    <div class="row g-3">

                        <!-- FILA 1 -->

                        <div class="col-md-4">
                            <label class="form-label">
                                Nivel
                            </label>

                            <select name="level"
                                    class="form-control"
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

                        <div class="col-md-4">
                            <label class="form-label">
                                Día
                            </label>

                            <select name="day_of_week"
                                    class="form-control">

                                <option <?= $lesson['day_of_week']=='Lunes' ? 'selected' : '' ?>>
                                    Lunes
                                </option>

                                <option <?= $lesson['day_of_week']=='Martes' ? 'selected' : '' ?>>
                                    Martes
                                </option>

                                <option <?= $lesson['day_of_week']=='Miércoles' ? 'selected' : '' ?>>
                                    Miércoles
                                </option>

                                <option <?= $lesson['day_of_week']=='Jueves' ? 'selected' : '' ?>>
                                    Jueves
                                </option>

                                <option <?= $lesson['day_of_week']=='Viernes' ? 'selected' : '' ?>>
                                    Viernes
                                </option>

                                <option <?= $lesson['day_of_week']=='Sábado' ? 'selected' : '' ?>>
                                    Sábado
                                </option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Entrenador
                            </label>

                            <select name="profile_id"
                                    class="form-control">

                                <?php foreach ($coaches as $coach): ?>

                                    <option
                                        value="<?= $coach['profile_id'] ?>"
                                        <?= $coach['profile_id'] == $lesson['profile_id'] ? 'selected' : '' ?>>

                                        <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                        <!-- FILA 2 -->

                        <div class="col-md-4">
                            <label class="form-label">
                                Hora Inicio
                            </label>

                            <input type="time"
                                   name="start_time"
                                   class="form-control"
                                   value="<?= $lesson['start_time'] ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Hora Fin
                            </label>

                            <input type="time"
                                   name="end_time"
                                   class="form-control"
                                   value="<?= $lesson['end_time'] ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Capacidad
                            </label>

                            <input type="number"
                                   name="capacity"
                                   class="form-control"
                                   value="<?= $lesson['capacity'] ?>">
                        </div>

                        <!-- BOTÓN -->

                        <div class="col-12 text-center mt-4">

                            <button type="submit"
                                    class="btn btn-primary-admin"
                                    style="
                                        width:240px;
                                        height:48px;
                                        border-radius:12px;
                                        font-weight:600;
                                    ">
                                Guardar cambios
                            </button>

                        </div>

                    </div>

                </form>
>>>>>>> 1807713 (Mejoras formularios admin)

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>