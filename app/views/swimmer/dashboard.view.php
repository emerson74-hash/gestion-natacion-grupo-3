<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4">

<div class="bg-white p-4 rounded shadow-sm">

    <!-- =========================
         DATOS USUARIO
    ========================== -->
<div class="d-flex align-items-center gap-3 mb-5">

    <?php

    $img = $_SESSION['profile_image'] ?? 'default-profile.png';

    $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);

    ?>

    <img 
        src="<?= $src ?>"
        alt="Foto perfil"
        class="rounded-circle border"
        style="
            width:65px;
            height:65px;
            object-fit:cover;
        "
    >

    <div>

        <h1 class="mb-1">
            Bienvenido Nadador
        </h1>

        <p class="text-muted mb-0">
            Consultá tus inscripciones y administrá tu perfil.
        </p>

    </div>

</div>


<div class="row justify-content-center g-4 swimmer-actions mb-5">

    <!-- PERFIL -->
    <div class="col-md-5">

        <a href="<?= _URL ?>/?url=swimmer/profile"
           class="text-decoration-none">

            <div class="dashboard-card-modern">

                <div class="dashboard-icon">
                    <i class="bi bi-person-circle"></i>
                </div>

                <h3>Mi Perfil</h3>

                <p>
                    Actualizá tu teléfono,
                    fecha de nacimiento y foto.
                </p>

            </div>

        </a>

    </div>

    <!-- CLASES -->
    <div class="col-md-5">

        <a href="<?= _URL ?>/?url=swimmer/lessons"
           class="text-decoration-none">

            <div class="dashboard-card-modern">

                <div class="dashboard-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <h3>Clases</h3>

                <p>
                    Explorá e inscribite
                    en las clases disponibles.
                </p>

            </div>

        </a>

    </div>

</div>

    <!-- =========================
         TABLA
    ========================== -->

    <h4 class="mb-3">
        Mis clases inscriptas
    </h4>

    <?php if (empty($myBookings)): ?>

        <div class="alert alert-info">

            Todavía no estás inscripto en ninguna clase.

            <a href="<?= _URL ?>/?url=swimmer/lessons">
                Ver clases disponibles
            </a>

        </div>

    <?php else: ?>

        <div class="table-responsive swimmer-table">

            <table id="misClasesTable" class="table table-hover table-sm align-middle">

                <thead>

                    <tr>

                        <th>
                            Nivel
                        </th>

                        <th>
                            Día
                        </th>

                        <th>
                            Horario
                        </th>

                        <th>
                            Profesor
                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $dayLabels = [

                    'Monday'=>'Lunes',
                    'Tuesday'=>'Martes',
                    'Wednesday'=>'Miércoles',
                    'Thursday'=>'Jueves',
                    'Friday'=>'Viernes',
                    'Saturday'=>'Sábado'

                ];

                foreach($myBookings as $b):

                ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($b['level'] ?? '—') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $dayLabels[$b['day_of_week']]
                                ?? $b['day_of_week']
                            ) ?>
                        </td>

                        <td>

                            <?= htmlspecialchars(substr($b['start_time'],0,5)) ?>

                            -

                            <?= htmlspecialchars(substr($b['end_time'],0,5)) ?>

                        </td>

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

</div>
<script>
$(document).ready(function () {

    const tableId = '#misClasesTable';

    if (!$.fn.DataTable.isDataTable(tableId)) {

        $(tableId).DataTable({

            language: {
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron resultados",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "Buscar:",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            },

            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
            responsive: true

        });

    }

});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>