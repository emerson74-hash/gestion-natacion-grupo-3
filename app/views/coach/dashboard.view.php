<?php include __DIR__ . '/../layouts/header.php'; ?>

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
    class="rounded-circle"
    style="
        width:100px;
        height:100px;
        object-fit:cover;
        border:3px solid #4FD1E8;
    ">

    <div>

        <h1 class="mb-1">
            ¡Bienvenido Entrenador!
        </h1>

        <p class="text-muted mb-0">
            Consultá tus clases asignadas y administrá tu perfil.
        </p>

    </div>

</div>
                <div class="row g-4 mt-5">

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
            </div>

        </div>

    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>