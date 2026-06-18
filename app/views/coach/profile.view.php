<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
<div class="col-md-6">

    <!-- BOTÓN ARRIBA DE LA CARD -->
 <div class="d-flex justify-content-end mb-2">
    <a href="?url=coach/dashboard"
       class="btn btn-sm btn-coach-back">
        Volver al panel
    </a>
</div>

    <div class="card coach-card">

        <div class="card-header text-center coach-header">
            <h4>Mi Perfil</h4>
        </div>
            
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-md-7">
                            <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION['first_name'] ?? '-') ?></p>
                            <p><strong>Apellido:</strong> <?= htmlspecialchars($_SESSION['last_name'] ?? '-') ?></p>
                            <p><strong>Especialidad:</strong> <?= htmlspecialchars($_SESSION['specialty'] ?? '-') ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email'] ?? '-') ?></p>

                            <a href="?url=coach/edit" class="btn text-light coach-primary mt-2">
                                Editar perfil
                            </a>
                        </div>

                        <div class="col-md-5 text-center">
                            <?php
                            $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                            $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                            ?>
                            <img src="<?= $rutaFoto ?>"
                                 class="rounded"
                                 style="width:150px; height:150px; object-fit:cover;">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>