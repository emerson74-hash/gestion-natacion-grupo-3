<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container mt-4">

    <h1 class="mb-4">Bienvenido, Admin Nerea</h1>
    <p class="text-muted">
    Administrá entrenadores y clases del sistema.
    </p>
    <p>Selecciona una opción para gestionar el sistema:</p>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card p-4 text-center h-100">
                <h4>Coaches </h4>
                <p>Gestión de entrenadores</p>

                <a href="?url=admin&section=coaches" class="btn btn-coach">
                    Entrar
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center h-100">
                <h4>Clases </h4>
                <p>Gestión de clases</p>

                <a href="?url=admin&section=lessons" class="btn btn-classes">
                    Entrar
                </a>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>