<?php include __DIR__ . '/users/layout/header.php'; ?>

<div class="bg-white p-5 rounded shadow-sm">


    <?php if ($_SESSION['role_id'] == 1): ?>
                                                <!-- VISTA PARA ROL ADMINISTRADOR -->

        <h1>Bienvenido, Admin</h1>

    <?php endif; ?>




    <?php if ($_SESSION['role_id'] == 2): ?>
                                                <!-- VISTA PARA ROL COACH -->

        <h1>Bienvenido, Profe</h1>
        <p class="lead">Este es el panel administrativo de la escuela.</p>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Alumnos activos</h5>
                        <p class="card-text fs-2">24</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>





<?php if ($_SESSION['role_id'] == 3): ?>
                                                <!-- VISTA PARA ROL SWIMMER -->

    <h1>Bienvenido, Swimmer</h1>

<?php endif; ?>





<?php include __DIR__ . '/users/layout/footer.php'; ?>