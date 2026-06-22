<!DOCTYPE html>
<html lang="es"></html>

<head>
    <meta name="base-url" content="<?= rtrim(Env::get('APP_URL'), '/') ?>">

    <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/toLowerFooter.css">

    <meta charset="UTF-8">
    <title><?= $titulo ?? 'SWIM LEARN' ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <?php
    $url = $_GET['url'] ?? '';

    if ($url == '' || $url == 'home') {

        ?>

        <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/landing.css">


        <?php

    } elseif (
        $url == 'login' ||
        $url == 'register' ||
        $url == 'forgot-password' ||
        $url == 'reset-password'
    ) {

        ?>

        <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/auth.css">


        <?php

    } else {

        ?>

        <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">


        <?php

    }

    ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>


    <style>
        .navbar {
            border-bottom: 2px solid #4FD1E8;
            padding: 6px 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: white !important;
            text-decoration: none;
        }

        .navbar-brand img {
            height: 50px;
            /* Ajustá si querés más grande o más chico */
            width: auto;
            display: block;
        }

        .text-swim {
            color: white;
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .profile-img-nav {
            width: 38px;
            height: 38px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #4FD1E8;
        }

        .navbar-nav {
            margin-right: 35px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid px-5">

                <a class="navbar-brand" href="<?= _URL ?>/?url=landing">

                <img src="/Gestion-Natacion-Grupo-3/public/imglogo/logo.png" alt="SWIM LEARN">

                <span class="text-swim">
                    SWIM LEARN
                </span>

            </a>

                <div class="collapse navbar-collapse">

                    <ul class="navbar-nav ms-auto align-items-center">

                        <?php if (isset($_SESSION['user_id'])): ?>

                            <?php
                            $foto = $_SESSION['profile_image'] ?? 'default-profile.png';

                            $rutaFoto =
                                Env::get('ASSET_URL')
                                . "/img/uploads/profiles/"
                                . $foto;
                            ?>

                            <li class="nav-item d-flex align-items-center">

                                <img src="<?= $rutaFoto ?>" alt="Perfil" class="profile-img-nav me-2">

                                <span class="nav-link text-info p-0">
                                    Hola
                                    <?= htmlspecialchars($_SESSION['first_name'] ?? '') ?>
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
    </header>

    <main>