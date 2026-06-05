<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? 'Escuela de Natación' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <style>
        .profile-img-nav {
            width: 35px;
            height: 35px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #17a2b8;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="<?= ($_SESSION['role_id'] ?? 0) == 2
                ? '?url=coach/dashboard'
                : '?url=landing' ?>">
                Centro de Natación 🚩
            </a>

            <div class="collapse navbar-collapse">

                <ul class="navbar-nav ms-auto align-items-center">

                    <?php if (isset($_SESSION['user_id'])): ?>

                        <li class="nav-item d-flex align-items-center">

                            <?php
                            $foto = $_SESSION['profile_image'] ?? 'default-profile.png';

                            $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                            ?>

                            <?php if(!empty($_SESSION['profile_image'])): ?>

                             <img src="<?= $rutaFoto ?>"
                              alt="Perfil"
                              class="profile-img-nav me-2">

                             <?php else: ?>

                             <i class="bi bi-person-circle fs-3 text-info me-2"></i>

                             <?php endif; ?>

                            <span class="nav-link text-info p-0">
                                Hola,
                                <?= htmlspecialchars($_SESSION['first_name'] ?? 'Usuario') ?>
                                
                            </span>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-danger btn-sm ms-3" href="?url=logout">
                                Salir
                            </a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="?url=login">Ingresar</a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>
    <main>