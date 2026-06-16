<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9 col-xl-8">
    <div class="card shadow-sm border-0 p-2 p-md-4">

 <div class="card-header bg-white border-0 py-3">

        <div class="card-header bg-white border-0 py-3 text-center">

    <h2 class="mb-0">Agregar Entrenador</h2>

    <small class="text-muted">
        Completa los datos del nuevo entrenador
    </small>

</div>

</div>
                <!-- FORM -->
                <div class="card-body p-3 p-md-4">

                    <form id="formCreateCoach"
                          method="POST"
                          action="?url=admin&section=store-coach"
                          enctype="multipart/form-data">

                        <div class="row g-4">

                            <!-- Nombre -->
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="first_name" class="form-control form-control-lg" id="name">
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6">
                                <label class="form-label">Apellido</label>
                                <input type="text" name="last_name" class="form-control form-control-lg" id="surname">
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-6">
                                <label class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="birth_date" class="form-control form-control-lg" id="birthDate">
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <label class="form-label">Teléfono</label>
                                <input type="text" name="phone" class="form-control form-control-lg" id="phone">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg">
                            </div>

                            <!-- Especialidad -->
                            <div class="col-md-6">
                                <label class="form-label">Especialidad</label>

                                <select name="specialty" class="form-select form-control-lg" required>
                                    <option value="">Seleccionar especialidad</option>
                                    <option value="Natación inicial">Natación inicial</option>
                                    <option value="Natación infantil">Natación intermedia</option>
                                    <option value="Natación adultos">Natación expertos</option>
  
                                </select>

                            </div>

                            <!-- BOTÓN -->
                            <div class="col-12 text-center mt-3">

                                <button type="submit"
                                        class="btn btn-primary-admin px-5 py-3"
                                        style="border-radius:12px; min-width:260px;">
                                    Guardar entrenador
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>