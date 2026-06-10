<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-12 col-xl-10">

            <div class="card p-4">

                <h2 class="text-center mb-4">
                    Crear Clase
                </h2>

                <form method="POST"
                      action="?url=admin&section=store-lesson">

                    <div class="row g-3">

                        <!-- FILA 1 -->

                        <div class="col-md-4">
<<<<<<< HEAD
                            <label class="form-label">Entrenador</label>
                            <select name="profile_id" class="form-control form-control-sm">
                                 <!--Esta opción hace que aparezca vacío por defecto-->
                           <option value="" disabled selected hidden>Selecciona un entrenador...</option>
=======
                            <label class="form-label">
                                Entrenador
                            </label>

                            <select name="profile_id"
                                    class="form-control"
                                    required>

>>>>>>> 1807713 (Mejoras formularios admin)
                                <?php foreach ($coaches as $coach): ?>

                                    <option value="<?= $coach['profile_id'] ?>">
                                        <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="col-md-4">
<<<<<<< HEAD
                            <label class="form-label">Nivel</label>
                            <select name="level" class="form-control form-control-sm" required>
                                  <!--Opción vacía por defecto-->
               <option value="" disabled selected hidden>Selecciona el nivel...</option>
                                <option value="Inicial">Inicial</option>
                                <option value="Intermedio">Intermedio</option>
                                <option value="Experto">Experto</option>
=======
                            <label class="form-label">
                                Nivel
                            </label>

                            <select name="level"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Seleccione un nivel
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

>>>>>>> 1807713 (Mejoras formularios admin)
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

                        <!-- FILA 2 -->

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