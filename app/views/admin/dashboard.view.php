<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="container py-4">

    <div class="bg-white p-5 rounded shadow-sm">

        <h1>Bienvenido Administrador</h1>

        <p class="lead">
            Gestioná usuarios, profesores y clases del sistema.
        </p>

        <hr>

        <div class="row justify-content-center g-4">

            <!-- ENTRENADORES -->

            <div class="col-md-5">

                <a href="?url=admin&section=coaches"
                   class="text-decoration-none">

                    <div class="coach-dashboard-card p-5 text-center">

                        <div class="coach-icon mb-4">
                            <i class="bi bi-person-badge"></i>
                        </div>

                        <h4>Entrenadores</h4>

                        <p>
                            Administre, organice y edite los entrenadores.
                        </p>

                    </div>

                </a>

            </div>

            <!-- CLASES -->

            <div class="col-md-5">

                <a href="?url=admin&section=lessons"
                   class="text-decoration-none">

                    <div class="coach-dashboard-card p-5 text-center">

                        <div class="coach-icon mb-4">
                            <i class="bi bi-calendar-week"></i>
                        </div>

                        <h4>Clases</h4>

                        <p>
                            Administre, organice y edite las clases.
                        </p>

                    </div>

                </a>

            </div>

        </div>

        <hr>

    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>