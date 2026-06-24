<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="container py-4">

    <div class="bg-white p-5 rounded-4 shadow-sm">

<div class="d-flex align-items-center gap-3 mb-5">

    <div
        class="rounded-circle d-flex align-items-center justify-content-center"
        style="
            width:100px;
            height:100px;
            background:linear-gradient(135deg,#4FD1E8,#2CB8D6);
            border:3px solid #4FD1E8;
            box-shadow:0 4px 15px rgba(79,209,232,.3);
        ">
        <i class="bi bi-shield-lock-fill text-white"
           style="font-size:3rem;"></i>
    </div>

    <div>

        <h1 class="mb-1">
            ¡Bienvenido Administrador!
        </h1>

        <p class="text-muted mb-0">
            Gestioná usuarios, entrenadores y clases del sistema.
        </p>

    </div>

</div>

        <div class="row justify-content-center g-4 mt-4">

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

    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>