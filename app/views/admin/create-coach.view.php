<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-8">

            <div class="card shadow-sm border-0 p-4">

                <h2 class="text-center mb-4">
                    Agregar Entrenador
                </h2>

                <form id="formCreateCoach" method="POST" action="?url=admin&section=store-coach"
                    enctype="multipart/form-data">

                    <div class="row g-4">

                        <!-- FILA 1 -->

                        <div class="col-md-4">
                            <label class="form-label">
                                Nombre
                            </label>

                            <input type="text" name="first_name" class="form-control" id="name">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Apellido
                            </label>

                            <input type="text" name="last_name" class="form-control" id="surname">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Fecha de nacimiento
                            </label>

                            <input type="date" name="birth_date" class="form-control" id="birthDate">
                        </div>

                        <!-- FILA 2 -->

                        <div class="col-md-4">
                            <label class="form-label">
                                Teléfono
                            </label>

                            <input type="text" name="phone" class="form-control" id="phone">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control" id="">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                Especialidad
                            </label>

                            <input type="text" name="specialty" class="form-control">
                        </div>

                        <!-- BOTÓN -->

                        <div class="col-12 text-center mt-4">

                            <button type="submit" class="btn btn-primary-admin" style="
                                    min-width:260px;
                                    padding:12px 30px;
                                    border-radius:12px;
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
<?php include __DIR__ . '/../users/layout/footer.php'; ?>