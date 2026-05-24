<!DOCTYPE html>
<html>
<head>
    <title>Escuela de Natacion</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS propio -->
    <link rel="stylesheet" href="/gestion-natacion-grupo-3/public/asset/css/admin.css">
</head>

<body>

<!-- Navar superior -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="?url=admin&section=dashboard">
            🏊 Panel Administrativo
        </a>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="?url=admin&section=dashboard">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?url=admin&section=coaches">Coaches</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?url=admin&section=swimmers">Swimmers</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?url=admin&section=classes">Clases</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="?url=logout">Salir</a>
                </li>

            </ul>

        </div>
    </div>
</nav>

<!-- CONTENIDO -->
<div class="container mt-4">

    <?php include $content; ?>

</div>

</body>
</html>