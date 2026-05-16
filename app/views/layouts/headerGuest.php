<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Swim Learn</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS propio -->
    <link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute w-100 z-3 py-3">

        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand fw-bold fs-3" href="?url=home">
                Swim Learn
            </a>

            <!-- BOTÓN HAMBURGUESA -->
            <button class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENÚ -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-4">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Actividades
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Servicios
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Contacto
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-outline-light rounded-pill px-4"
                            href="?url=login">

                            Iniciar sesión
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>