<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9 col-xl-8">

            <div class="card shadow-sm border-0 p-2 p-md-4">

                <!-- HEADER -->
                <div class="card-header bg-white border-0 text-center py-4">

                    <h2 class="mb-0">
                        Crear Clase
                    </h2>

                    <small class="text-muted">
                        Completa los datos de la nueva clase
                    </small>

                </div>

                <!-- BODY -->
                <div class="card-body p-3 p-md-4">

                    <form method="POST"
                          action="?url=admin&section=store-lesson">

                        <div class="row g-4">

                            <!-- Entrenador -->
                            <div class="col-md-6">
                                <label class="form-label">Entrenador</label>

                                <select name="profile_id"
                                        class="form-select form-control-lg"
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

                            <!-- Nivel -->
                            <div class="col-md-6">
                                <label class="form-label">Nivel</label>

                                <select name="level"
                                        class="form-select form-control-lg"
                                        required>

                                    <option value="" disabled selected hidden>
                                        Selecciona el nivel...
                                    </option>

                                    <option value="Inicial">Inicial</option>
                                    <option value="Intermedio">Intermedio</option>
                                    <option value="Experto">Experto</option>

                                </select>
                            </div>

                            <!-- Día -->
                            <div class="col-md-6">
                                <label class="form-label">Día</label>

                                <select name="day_of_week"
                                        class="form-select form-control-lg"
                                        required>

                                    <option value="Monday">Lunes</option>
                                    <option value="Tuesday">Martes</option>
                                    <option value="Wednesday">Miércoles</option>
                                    <option value="Thursday">Jueves</option>
                                    <option value="Friday">Viernes</option>
                                    <option value="Saturday">Sábado</option>

                                </select>
                            </div>

                            <!-- Hora inicio -->
                            <div class="col-md-6">
                                <label class="form-label">Hora inicio</label>

                                <input type="time"
                                       name="start_time"
                                       class="form-control form-control-lg"
                                       required>
                            </div>

                            <!-- Hora fin -->
                            <div class="col-md-6">
                                <label class="form-label">Hora fin</label>

                                <input type="time"
                                       name="end_time"
                                       class="form-control form-control-lg"
                                       required>
                            </div>

                            <!-- Capacidad -->
                            <div class="col-md-6">
                                <label class="form-label">Capacidad</label>

                                <input type="number"
                                       name="capacity"
                                       class="form-control form-control-lg"
                                       value="20"
                                       required>
                            </div>

                            <!-- BOTÓN -->
                            <div class="col-12 text-center mt-3">

                                <button type="submit"
                                        class="btn btn-primary-admin px-5 py-3"
                                        style="border-radius:12px; min-width:260px;">
                                    Crear Clase
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