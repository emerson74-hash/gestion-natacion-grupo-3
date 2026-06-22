<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

                        <div class="d-flex align-items-center gap-3 mb-4">

    <?php

    $img = $_SESSION['profile_image'] ?? 'default-profile.png';

    $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);

    ?>

    <img
        src="<?= $src ?>"
        alt="Foto perfil"
        class="rounded-circle border"
        style="
            width:65px;
            height:65px;
            object-fit:cover;
        "
    >

    <div>

        <h1 class="mb-1">
            Bienvenido Entrenador
        </h1>

        <p class="text-muted mb-0">
            Consultá tus clases asignadas y administrá tu perfil.
        </p>

    </div>

</div>

                <hr>

                <div class="row g-4 mt-2">

                    <div class="col-md-6">
                        <a href="?url=coach/lessons"
                            class="card coach-dashboard-card text-decoration-none h-100">

                            <div class="card-body text-center p-4">

                                <div class="coach-icon mb-3">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>

                                <h4 class="mb-3">
                                    Ver calendario de clases
                                </h4>

                                <p class="text-muted">
                                    Consultá horarios, actividades y clases asignadas.
                                </p>

                            </div>

                        </a>
                    </div>

                    <div class="col-md-6">
                        <a href="?url=coach/profile"
                            class="card coach-dashboard-card text-decoration-none h-100">

                            <div class="card-body text-center p-4">

                            <div class="coach-icon mb-3">
                                <i class="bi bi-person-circle"></i>
                            </div>

                                <h4 class="mb-3">
                                    Editar datos personales
                                </h4>

                                <p class="text-muted">
                                    Actualizá tu información personal y datos de contacto.
                                </p>

                            </div>

                        </a>
                    </div>

                </div>

                <hr>

            </div>

        </div>

    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>