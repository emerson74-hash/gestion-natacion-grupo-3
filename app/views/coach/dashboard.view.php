<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

                <h1>Bienvenido Entrenador</h1>
                <p class="lead">Este es el panel administrativo de la escuela.</p>

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
                                    <i class="fas fa-user-edit"></i>
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

<?php include __DIR__ . '/../users/layout/footer.php'; ?>