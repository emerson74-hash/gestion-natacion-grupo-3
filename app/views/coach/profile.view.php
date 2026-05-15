<?php include __DIR__ . '/../layout/headers/header_coach.php'; ?>

<!-- AYUDIN container->row->col -->

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6 fs-1">


            Hola,
            <?= htmlspecialchars(
                ($_SESSION['first_name'] ?? 'Usuario')
                . ' ' .
                ($_SESSION['last_name'] ?? 'xd')
            ) ?>
            <span class="nav-link text-info p-0">
                                Hola,
                                <?= htmlspecialchars($_SESSION['last_name'] ?? 'Usuario') ?>
                            </span>

            <p class="fs-2">Este es el panel de perfil</p>

        </div>
        <div class="col text-center  img-fluid ">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/swimmers/" . $foto;
                ?>
                    <img src="<?= $rutaFoto ?>" alt="Perfil" class="profile-img-size me-2">


            <?php endif; ?>
        </div>

    </div>




</div>








<?php include __DIR__ . '/../users/layout/footer.php'; ?>