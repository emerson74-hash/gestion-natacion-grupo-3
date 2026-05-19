<?php include __DIR__ . '/header.php'; ?>

<div class="container mt-4">

    <h1 class="mb-4">Bienvenido, Admin </h1>
    <p>Selecciona una opción para gestionar el sistema:</p>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <h4>Coaches</h4>
                <p>Gestión de entrenadores</p>

                <a href="?url=admin&section=coaches" class="btn btn-primary">
                    Entrar
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <h4>Swimmers</h4>
                <p>Gestión de alumnos</p>

                <a href="?url=admin&section=swimmers" class="btn btn-success">
                    Entrar
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 text-center">
                <h4>Clases</h4>
                <p>Gestión de clases</p>

                <a href="?url=admin&section=classes" class="btn btn-warning">
                    Entrar
                </a>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/footer.php'; ?>