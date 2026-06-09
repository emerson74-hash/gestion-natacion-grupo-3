<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-10">

            <div class="card p-4 p-md-4">

                <h2 class="text-center mb-3">
                    Agregar Entrenador
                </h2>

                <form method="POST"
                      action="?url=admin&section=store-coach"
                      enctype="multipart/form-data">

                    <div class="row g-2">

                        <!-- FILA 1 -->
                        <div class="col-md-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="first_name"
                                   class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="last_name"
                                   class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Fecha nacimiento</label>
                            <input type="date" name="birth_date"
                                   class="form-control form-control-sm">
                        </div>

                        <!-- FILA 2 -->
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="phone"
                                   class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                   class="form-control form-control-sm">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Especialidad</label>
                            <input type="text" name="specialty"
                                   class="form-control form-control-sm">
                        </div>

                        <!-- BOTÓN -->
                        <div class="col-12 mt-4 d-flex justify-content-center">

                            <button type="submit"
                                    class="btn btn-primary-admin"
                                    style="
                                        padding:12px 45px;
                                        font-size:16px;
                                        border-radius:12px;
                                        min-width:240px;
                                    ">
                                Guardar entrenador
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>