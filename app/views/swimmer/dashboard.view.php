<?php include __DIR__ . '/../users/layout/header.php'; ?>


<!-- Contenedor principal -->
<div class="bg-white p-5 rounded shadow-sm">

    <!-- Datos principales del usuario -->
    <div class="d-flex align-items-center gap-3 mb-4">

        <?php
            // Tomamos la imagen guardada en sesión
            // Si no tiene, usamos la imagen por defecto
            $img = $_SESSION['profile_image'] ?? 'default-profile.png';

            // Armamos la ruta completa de la imagen
            $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);
        ?>

        <!-- Imagen de perfil -->
        <img src="<?= $src ?>"
             alt="Foto de perfil"
             class="rounded-circle border"
             style="width:64px; height:64px; object-fit:cover;">

        <div>

            <!-- Nombre del usuario -->
            <h1 class="mb-0">
                Bienvenido, <?= htmlspecialchars($_SESSION['first_name'] ?? 'Swimmer') ?>
            </h1>

            <!-- Email del usuario -->
            <small class="text-muted">
                <?= htmlspecialchars($user) ?>
            </small>

        </div>
    </div>

    <hr>

    <!-- Accesos rápidos -->
    <div class="row g-3 mb-4">

        <!-- Tarjeta para ir al perfil -->
        <div class="col-md-6">
            <a href="<?= _URL ?>/?url=swimmer/profile" class="text-decoration-none">

               <div class="card text-white h-100" style="background-color: #17a2b8;">
                    <div class="card-body">

                        <h5 class="card-title">Mi Perfil</h5>

                        <p class="card-text">
                            Actualizá tu teléfono, fecha de nacimiento y foto.
                        </p>

                    </div>
                </div>

            </a>
        </div>

        <!-- Tarjeta para ver clases -->
        <div class="col-md-6">
            <a href="<?= _URL ?>/?url=swimmer/lessons" class="text-decoration-none">

                <div class="card text-white h-100" style="background-color: #17a2b8;">
                    <div class="card-body">

                        <h5 class="card-title">Clases Disponibles</h5>

                        <p class="card-text">
                            Explorá y anotate en las clases del cronograma.
                        </p>

                    </div>
                </div>

            </a>
        </div>
    </div>

    <!-- Título de la tabla -->
    <h4 class="mb-3">Mis clases inscriptas</h4>

    <?php if (empty($myBookings)): ?>

        <!-- Mensaje si no tiene clases -->
        <div class="alert alert-info">

            Todavía no estás inscripto en ninguna clase.

            <a href="<?= _URL ?>/?url=swimmer/lessons">
                Ver clases disponibles →
            </a>

        </div>

    <?php else: ?>

        <!-- Tabla responsive -->
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <!-- Encabezado -->
                <thead class="table-light">
                    <tr>
                        <th>Nivel</th>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Profesor</th>
                    </tr>
                </thead>

                <tbody>

                <?php

                    // Traducción de días en inglés a español
                    $dayLabels = [
                        'Monday'    => 'Lunes',
                        'Tuesday'   => 'Martes',
                        'Wednesday' => 'Miércoles',
                        'Thursday'  => 'Jueves',
                        'Friday'    => 'Viernes',
                        'Saturday'  => 'Sábado',
                    ];

                    // Recorremos todas las clases del swimmer
                    foreach ($myBookings as $b):

                ?>

                    <tr>

                        <!-- Nivel -->
                        <td>
                            <?= htmlspecialchars($b['level'] ?? '—') ?>
                        </td>

                        <!-- Día -->
                        <td>
                            <?= htmlspecialchars($dayLabels[$b['day_of_week']] ?? $b['day_of_week']) ?>
                        </td>

                        <!-- Horario -->
                        <td>

                            <?= htmlspecialchars(substr($b['start_time'], 0, 5)) ?>

                            –

                            <?= htmlspecialchars(substr($b['end_time'], 0, 5)) ?>

                        </td>

                        <!-- Nombre del coach -->
                        <td>
                            <?= htmlspecialchars($b['coach_name']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    <?php endif; ?>

</div>

<?php


include __DIR__ . '/../users/layout/footer.php';

?>

