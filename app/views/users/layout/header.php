<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $titulo ?? 'Escuela de Natación' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <a class="navbar-brand" href="?url=home">SwimManager 🚩</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <?php
                $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/swimmers/" . $foto;
                ?>
                <img src="<?= $rutaFoto ?>" alt="Perfil" class="profile-img-nav me-2">

                <span class="nav-link text-info p-0">
                    Hola,
                    <?= htmlspecialchars($_SESSION['first_name'] ?? 'Usuario') ?>
                </span>
            <?php endif; ?>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-center">

                    <?php if (isset($_SESSION['user_id'])): ?>

                        <?php $role = $_SESSION['role_id']; ?>

                        <?php if ($role == 2): ?>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Coach</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?url=coach/profile">Perfil</a>
                            </li>
                        <?php endif; ?>

                    <?php endif; ?>

                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item d-flex align-items-center">



                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-danger btn-sm ms-3" href="?url=logout">Salir</a>
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
    <main class="container mt-4">