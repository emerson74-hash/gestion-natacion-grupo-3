<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <!-- MISMO ANCHO QUE EL OTRO FORM -->
        <div class="col-12 col-lg-9 col-xl-8">

            <div class="card shadow-sm border-0 p-2 p-md-4">

                <!-- HEADER -->
                <div class="card-header bg-white border-0 text-center py-4">

                    <h2 class="mb-0">
                        Editar Entrenador
                    </h2>

                    <small class="text-muted">
                        Modificá los datos del entrenador
                    </small>

                </div>

                <!-- BODY -->
                <div class="card-body p-3 p-md-4">

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
                                       class="form-control form-control-lg"
                                       value="<?= $coach['first_name'] ?>"
                                       required>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6">
                                <label class="form-label">Apellido</label>
                                <input type="text"
                                       name="last_name"
                                       class="form-control form-control-lg"
                                       value="<?= $coach['last_name'] ?>"
                                       required>
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-6">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date"
                                    name="birth_date"
                                    class="form-control form-control-lg"
                                    value="<?= $coach['birth_date'] ?? '' ?>">
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control form-control-lg"
                                       value="<?= $coach['phone'] ?? '' ?>">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control form-control-lg"
                                       value="<?= $coach['email'] ?>"
                                       required>
                            </div>

                            <!-- Especialidad -->
                                    <div class="col-md-6">
                                        <label class="form-label">Especialidad</label>
                                    <select name="specialty" class="form-select form-control-lg" required>

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