<?php include __DIR__ . '/../users/layout/header.php'; ?>
<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">

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


            <p class="fs-2">Este es el panel de perfil</p>

        </div>
        <div class="container mt-5">

            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow-sm">
                        <div class="card-header text-center colorsitoPiola text-white">
                            <h4>Mi Perfil</h4>
                        </div>

                        <div class="row">
                            <div class="card-body col-md-3">

                                <p><strong>Nombre:</strong> <?= htmlspecialchars(
                                    ($_SESSION['first_name'] ?? '-')

                                ) ?></p>

                                <p><strong>Apellido:</strong> <?= htmlspecialchars(
                                    ($_SESSION['last_name'] ?? '-')

                                ) ?></p>

                                <p><strong>Especialidad:</strong> <?= htmlspecialchars(

                                    ($_SESSION['specialty'] ?? '-')
                                ) ?></p>

                                <p><strong>Email:</strong>
                                    <?= htmlspecialchars(
                                        ($_SESSION['email'] ?? '-')

                                    ) ?>
                                    </< /p>
                                    <a href="?url=coach/edit" class="btn text-light colorsitoPiola">
                                        Editar perfil
                                    </a>

                            </div>
                            <div class="card-body col-md-3 p-0" style="height: 200px; overflow-hidden;">

                                <?php
                                $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                                $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                                ?>

                                <img src="<?= $rutaFoto ?>" class="w-100 h-100 object-fit-cover object-position-center">

                            </div>
                        </div>



                    </div>

                </div>
            </div>

        </div>

    </div>




</div>








<?php include __DIR__ . '/../users/layout/footer.php'; ?>