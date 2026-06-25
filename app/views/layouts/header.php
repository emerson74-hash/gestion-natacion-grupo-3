<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="base-url" content="<?= rtrim(Env::get('APP_URL'), '/') ?>">

    <title><?= $titulo ?? 'SWIM LEARN' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/toLowerFooter.css">
    <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/header.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <?php
    $url = $_GET['url'] ?? '';

    if ($url === '' || $url === 'home') { ?>
        <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/landing.css">
    <?php } elseif (
        in_array($url, ['login', 'register', 'forgot-password', 'reset-password'])
    ) { ?>
        <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/auth.css">
    <?php } else { ?>
        <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center" href="<?= _URL ?>/?url=landing">
                <img src="<?= Env::get('ASSET_URL') ?>/imglogo/logo.png" alt="SWIM LEARN">
                <span class="text-swim ms-2">SWIM LEARN</span>
            </a>

            <!-- PARTE DERECHA MODERNA -->
            <?php if (isset($_SESSION['user_id'])): ?>

                <?php
                $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                ?>

                <div class="navbar-right ms-auto d-flex align-items-center gap-3">

                    <div class="navbar-user d-flex align-items-center">
                        <img src="<?= $rutaFoto ?>"
                             alt="Perfil"
                             class="profile-img-nav">

                        <span class="user-greeting ms-2">
                            Hola, <?= htmlspecialchars($_SESSION['first_name'] ?? '') ?>
                        </span>
                    </div>

                    <a class="btn btn-logout" href="?url=logout">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Salir
                    </a>

                </div>

            <?php else: ?>

                <?php if (!in_array($url, ['login', 'register'])): ?>
                    <div class="ms-auto">
                        <a class="nav-link text-white" href="?url=login">
                            Ingresar
                        </a>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </nav>
</header>

<main>