<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-8 col-xl-7">

            <div class="card p-4">

                <h2 class="text-center mb-4">
                    Crear Clase
                </h2>

                <form method="POST"
                      action="?url=admin&section=store-lesson">

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label">
                                Entrenador
                            </label>

                            <select name="profile_id"
                                    class="form-control"
                                    required>

                                <option value="" disabled selected hidden>
                                    Selecciona un entrenador...
                                </option>

                                <?php foreach ($coaches as $coach): ?>

                                    <option value="<?= $coach['profile_id'] ?>">
                                        <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Nivel
                            </label>

                            <select name="level"
                                    class="form-control"
                                    required>

                                <option value="" disabled selected hidden>
                                    Selecciona el nivel...
                                </option>

                                <option value="Inicial">
                                    Inicial
                                </option>

                                <option value="Intermedio">
                                    Intermedio
                                </option>

                                <option value="Experto">
                                    Experto
                                </option>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Día
                            </label>

                            <select name="day_of_week"
                                    class="form-control"
                                    required>

                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>

                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Hora Inicio
                            </label>

                            <input type="time"
                                   name="start_time"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Hora Fin
                            </label>

                            <input type="time"
                                   name="end_time"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Capacidad
                            </label>

                            <input type="number"
                                   name="capacity"
                                   class="form-control"
                                   value="20"
                                   required>

                        </div>

                        <div class="col-12 text-center mt-4">

                            <button type="submit"
                                    class="btn btn-primary-admin"
                                    style="
                                        min-width:260px;
                                        padding:12px 30px;
                                        border-radius:12px;
                                    ">
                                Crear Clase
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>