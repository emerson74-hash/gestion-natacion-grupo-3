<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6">

            <div class="card p-5">

                <h1 class="text-center mb-4">
                    Agregar Entrenador
                </h1>

                <form 
                  method="POST" 
                  action="?url=admin&section=store-coach"
                  enctype="multipart/form-data"
                >
                <div class="row">
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nombre
                        </label>

                        <input 
                            type="text"
                            name="first_name"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Apellido
                        </label>

                        <input 
                            type="text"
                            name="last_name"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                    <label class="form-label">
                    Fecha de nacimiento
                    </label>

                    <input 
                    type="date"
                    name="birth_date"
                    class="form-control"
                    >

                    </div>

                    <div class="col-md-6 mb-3">

                    <label class="form-label">
                     Teléfono
                    </label>

                    <input 
                    type="text"
                    name="phone"
                    class="form-control"
                    >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input 
                            type="email"
                            name="email"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Especialidad
                        </label>

                        <input 
                            type="text"
                            name="specialty"
                            class="form-control"
                            required
                        >


                        <div class="d-flex gap-2">

                      <!--  <a 
                            href="?url=admin&section=coaches"
                            class="btn btn-secondary w-50"
                        >
                            ← Volver
                        </a> -->

                    <button 
                    type="submit" 
                    class="btn btn-primary w-100 py-2"
                    >
                        Guardar entrenador
                    </button>

                    </div>

                </form>

               </div>

            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>