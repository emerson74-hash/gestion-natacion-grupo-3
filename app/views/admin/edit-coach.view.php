<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-9">

            <div class="card p-4 p-md-4">

                <h2 class="text-center mb-4">
                    Editar Entrenador
                </h2>

                <form method="POST"
                      action="?url=admin&section=update-coach">

                    <input type="hidden"
                           name="id"
                           value="<?= $coach['id'] ?>">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">
                                Nombre
                            </label>

                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   value="<?= $coach['first_name'] ?>"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Apellido
                            </label>

                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   value="<?= $coach['last_name'] ?>"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Fecha de nacimiento
                            </label>

                            <input type="date"
                                   name="birth_date"
                                   class="form-control"
                                   value="<?= $coach['birth_date'] ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Teléfono
                            </label>

                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="<?= $coach['phone'] ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="<?= $coach['email'] ?>"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Especialidad
                            </label>

                            <input type="text"
                                   name="specialty"
                                   class="form-control"
                                   value="<?= $coach['specialty'] ?>"
                                   required>
                        </div>

                        <div class="col-12 mt-4 text-center">

                            <button
                                type="submit"
                                class="btn btn-primary-admin"
                                style="
                                    min-width:260px;
                                    padding:12px 30px;
                                    border-radius:12px;
                                ">
                                Guardar cambios
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>