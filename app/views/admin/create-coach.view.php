<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-9 col-xl-8">

            <div class="card shadow-sm border-0 p-2 p-md-4">

                <!-- HEADER -->
                <div class="card-header text-center py-4">

                    <h2 class="mb-1">
                        Agregar Entrenador
                    </h2>

                    <small>
                        Completa los datos del nuevo entrenador
                    </small>

                </div>


                <!-- BODY -->
                <div class="card-body p-3 p-md-4">


                    <form id="formCreateCoach"
                          method="POST"
                          action="?url=admin&section=store-coach"
                          enctype="multipart/form-data">


                        <div class="row g-4">


                            <!-- Nombre -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Nombre
                                </label>

                                <input type="text"
                                       name="first_name"
                                       class="form-control form-control-lg admin-control"
                                       id="name">

                            </div>


                            <!-- Apellido -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Apellido
                                </label>

                                <input type="text"
                                       name="last_name"
                                       class="form-control form-control-lg admin-control"
                                       id="surname">

                            </div>


                            <!-- Fecha -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Fecha de nacimiento
                                </label>

                                <input type="date"
                                       name="birth_date"
                                       class="form-control form-control-lg admin-control"
                                       id="birthDate">

                            </div>


                            <!-- Teléfono -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Teléfono
                                </label>

                                <input type="text"
                                       name="phone"
                                       class="form-control form-control-lg admin-control"
                                       id="phone">

                            </div>


                            <!-- Email -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Email
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control form-control-lg admin-control">

                            </div>


                            <!-- Especialidad -->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Especialidad
                                </label>


                                <select name="specialty"
                                        class="form-select form-control-lg admin-control"
                                        required>


                                    <option value="">
                                        Seleccionar especialidad
                                    </option>


                                    <option value="Natación inicial">
                                        Natación inicial
                                    </option>


                                    <option value="Natación intermedia">
                                        Natación intermedia
                                    </option>


                                    <option value="Natación avanzada">
                                        Natación avanzada
                                    </option>


                                </select>

                            </div>



                        <!-- BOTONES -->

                        <div class="col-12">

                            <div class="btn-container">


                                <a href="?url=admin&section=coaches"
                                class="btn-secondary-admin admin-btn">

                                    Cancelar

                                </a>


                                <button type="submit"
                                        class="btn-primary-admin admin-btn">

                                    Guardar entrenador

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