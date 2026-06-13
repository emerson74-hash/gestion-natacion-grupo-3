<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="base-url" content="<?= rtrim(Env::get('APP_URL'), '/') ?>">

    <title><?= $titulo ?? 'SWIM LEARN' ?></title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- TOASTR -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- CROPPER -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <!-- CSS -->
    <?php
    $url = $_GET['url'] ?? '';

    if ($url == '' || $url == 'home') {
        echo '<link rel="stylesheet" href="' . Env::get('ASSET_URL') . '/assets/css/landing.css">';
    } elseif (
        $url == 'login' ||
        $url == 'register' ||
        $url == 'forgot-password' ||
        $url == 'reset-password'
    ) {
        echo '<link rel="stylesheet" href="' . Env::get('ASSET_URL') . '/assets/css/auth.css">';
    } else {
        echo '<link rel="stylesheet" href="' . Env::get('ASSET_URL') . '/assets/css/app.css">';
    }
    ?>

    <!-- SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- JS PRINCIPAL -->
<script type="module" src="/gestion-natacion-grupo-3/public/js/modules/authMain.js"></script>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid px-5">

        <a class="navbar-brand" href="<?=
            match ($_SESSION['role_id'] ?? 0) {
                1 => '?url=admin&section=dashboard',
                2 => '?url=coach/dashboard',
                3 => '?url=swimmer/dashboard',
                default => '?url=landing'
            }
        ?>">

            <img src="<?= Env::get('ASSET_URL') ?>/imglogo/logo.png" alt="SWIM LEARN">

            <span class="text-swim">SWIM LEARN</span>

        </a>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto align-items-center">

                <?php if (isset($_SESSION['user_id'])): ?>

                    <?php
                    $foto = $_SESSION['profile_image'] ?? 'default-profile.png';

                    $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                    ?>

                    <li class="nav-item d-flex align-items-center">

                        <img src="<?= $rutaFoto ?>" alt="Perfil" class="profile-img-nav me-2">

                        <span class="nav-link text-info p-0">
                            Hola <?= htmlspecialchars($_SESSION['first_name'] ?? '') ?>
                        </span>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-info btn-sm ms-3" href="?url=logout">
                            Salir
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="?url=login">
                            Ingresar
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>
</nav>

<main>