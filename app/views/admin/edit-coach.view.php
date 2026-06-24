<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="container page-coach-edit">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9 col-xl-8">

            <div class="coach-card">

                <!-- HEADER -->
                <div class="coach-header">
                    <h2>Editar Entrenador</h2>
                    <small>Modificá los datos del entrenador</small>
                </div>

                <!-- BODY -->
                <div class="card-body p-3 p-md-3">

                    <form method="POST"
                          action="?url=admin&section=update-coach">

                        <input type="hidden"
                               name="id"
                               value="<?= $coach['id'] ?>">

                        <div class="row g-4">

                            <!-- Nombre -->
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text"
                                       name="first_name"
                                       class="form-control coach-input"
                                       value="<?= $coach['first_name'] ?>"
                                       required>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6">
                                <label class="form-label">Apellido</label>
                                <input type="text"
                                       name="last_name"
                                       class="form-control coach-input"
                                       value="<?= $coach['last_name'] ?>"
                                       required>
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-6">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date"
                                       name="birth_date"
                                       class="form-control coach-input"
                                       value="<?= $coach['birth_date'] ?? '' ?>">
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control coach-input"
                                       value="<?= $coach['phone'] ?? '' ?>">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control coach-input"
                                       value="<?= $coach['email'] ?>"
                                       required>
                            </div>

                            <!-- Especialidad -->
                            <div class="col-md-6">
                                <label class="form-label">Especialidad</label>

                                <select name="specialty"
                                        class="form-select coach-input"
                                        required>

                                    <option value="">Seleccionar especialidad</option>

                                    <option value="Natación inicial"
                                        <?= $coach['specialty'] == 'Natación inicial' ? 'selected' : '' ?>>
                                        Natación inicial
                                    </option>

                                    <option value="Natación intermedia"
                                        <?= $coach['specialty'] == 'Natación intermedia' ? 'selected' : '' ?>>
                                        Natación intermedia
                                    </option>

                                    <option value="Natación avanzada"
                                        <?= $coach['specialty'] == 'Natación avanzada' ? 'selected' : '' ?>>
                                        Natación avanzada
                                    </option>

                                </select>
                            </div>

                            <!-- BOTONES -->
                            <div class="col-12 mt-4">

                                <div class="d-flex flex-column flex-md-row justify-content-center gap-3">

                                    <a href="?url=admin&section=coaches"
                                       class="btn btn-cancel-coach">
                                        Cancelar
                                    </a>

                                    <button type="submit"
                                            class="btn btn-save-coach">
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