<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9">

            <div class="card p-4 p-md-4">

                <h1 class="text-center mb-3">
                    Crear Clase
                </h1>

                <form method="POST"
                      action="?url=admin&section=store-lesson"
                      enctype="multipart/form-data">

                    <div class="row g-2">

                        <!-- FILA 1 -->
                        <div class="col-md-4">
                            <label class="form-label">Entrenador</label>
                            <select name="profile_id" class="form-control form-control-sm">
                                 <!--Esta opción hace que aparezca vacío por defecto-->
                           <option value="" disabled selected hidden>Selecciona un entrenador...</option>
                                <?php foreach ($coaches as $coach): ?>
                                    <option value="<?= $coach['profile_id'] ?>">
                                        <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nivel</label>
                            <select name="level" class="form-control form-control-sm" required>
                                  <!--Opción vacía por defecto-->
               <option value="" disabled selected hidden>Selecciona el nivel...</option>
                                <option value="Inicial">Inicial</option>
                                <option value="Intermedio">Intermedio</option>
                                <option value="Experto">Experto</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Día</label>
                            <select name="day_of_week" class="form-control form-control-sm">
                                <!--Opción vacía por defecto-->
                       <option value="" disabled selected hidden>Selecciona el día...</option>
                                <option>Lunes</option>
                                <option>Martes</option>
                                <option>Miércoles</option>
                                <option>Jueves</option>
                                <option>Viernes</option>
                                <option>Sábado</option>
                            </select>
                        </div>

                        <!-- FILA 2 -->
                        <div class="col-md-4">
                            <label class="form-label">Inicio</label>
                            <input type="time" name="start_time"
                                   class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fin</label>
                            <input type="time" name="end_time"
                                   class="form-control form-control-sm" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Capacidad</label>
                            <input type="number" name="capacity"
                                   class="form-control form-control-sm"
                                   value="20">
                        </div>

                        <!-- BOTÓN -->
                        <div class="col-12 mt-4 d-flex justify-content-center">

                            <button class="btn btn-primary-admin"
                                    style="
                                        padding:12px 40px;
                                        font-size:16px;
                                        border-radius:12px;
                                        min-width:220px;
                                    ">
                                Crear clase
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>