<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container mt-4">

    <h1 class="mb-4">Bienvenido, Administrador</h1>

    <p class="text-muted">
        
    </p>

    <p>Selecciona una opción para realizar en el sistema:</p>

    <div class="row mt-4">

        <div class="col-md-5">
            <div class="card p-4 text-center h-100">
                <h4>Entrenadores</h4>
                <p>Administre, organice y edite.</p>

                <a href="?url=admin&section=coaches"
                   class="btn-admin btn-primary-admin">
                    Entrar
                </a>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4 text-center h-100">
                <h4>Clases</h4>
                <p>Administre, organice y edite.</p>

                <a href="?url=admin&section=lessons"
                   class="btn-admin btn-primary-admin">
                    Entrar
                </a>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>