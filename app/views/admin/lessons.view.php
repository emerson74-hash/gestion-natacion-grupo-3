<?php include __DIR__ . '/../layouts/header.php'; ?>

<?php
// Mapa días inglés → español (definido una sola vez, fuera del loop)
$days = [
    'Monday'    => 'Lunes',
    'Tuesday'   => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday'  => 'Jueves',
    'Friday'    => 'Viernes',
    'Saturday'  => 'Sábado',
    'Sunday'    => 'Domingo',
];
?>

<div class="container mt-4">

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

    <h2 class="mb-0">Gestión de clases</h2>

    <div class="d-flex gap-2 ms-auto">
        <a href="?url=admin&section=dashboard"
           class="btn-admin btn-secondary-admin">
            Volver al panel
        </a>
        <a href="?url=admin&section=create-lesson"
           class="btn-admin btn-primary-admin">
            <i class="bi bi-plus-lg"></i>
            Agregar clase
        </a>
    </div>

</div>

<div class="card shadow-sm mx-auto">
    <div class="card-body">
        <div class="table-responsive-custom">

            <table id="tablaClasesAdmin" class="table table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>Día</th>
                        <th>Nivel</th>
                        <th>Comienzo</th>
                        <th>Final</th>
                        <th>Capacidad</th>
                        <th>Entrenador</th>
                        <th>Reservas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($lessons as $lesson): ?>
                        <tr>
                            <td><?= htmlspecialchars($days[$lesson['day_of_week']] ?? $lesson['day_of_week']) ?></td>
                            <td><?= htmlspecialchars($lesson['level']) ?></td>
                            <td><?= htmlspecialchars(substr($lesson['start_time'], 0, 5)) ?></td>
                            <td><?= htmlspecialchars(substr($lesson['end_time'], 0, 5)) ?></td>
                            <td><?= htmlspecialchars($lesson['capacity']) ?></td>
                            <td><?= htmlspecialchars($lesson['coach_name']) ?></td>
                            <td><?= htmlspecialchars($lesson['booked_count']) ?></td>
                            <td>
                                <div class="actions">
                                    <a href="?url=admin&section=edit-lesson&id=<?= $lesson['id'] ?>"
                                       class="btn-admin btn-warning-admin">
                                        Editar
                                    </a>
                                    <a href="?url=admin&section=delete-lesson&id=<?= $lesson['id'] ?>"
                                       class="btn-admin btn-danger-admin btn-sm btn-delete">
                                        Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
