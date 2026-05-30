<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container mt-4">

    <h2 class="mb-3">Gestión de Clases</h2>

    <a href="?action=createLesson" class="btn btn-primary mb-3">
        Crear Clases
    </a>

    <div class="card shadow-sm mx-auto" style="max-width: 1100px;">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-sm align-middle text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>Nivel</th>
                            <th>Día</th>
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

                                <td><?= htmlspecialchars($lesson['level']) ?></td>
                                <td><?= htmlspecialchars($lesson['day_of_week']) ?></td>
                                <td><?= htmlspecialchars($lesson['start_time']) ?></td>
                                <td><?= htmlspecialchars($lesson['end_time']) ?></td>
                                <td><?= htmlspecialchars($lesson['capacity']) ?></td>
                                <td><?= htmlspecialchars($lesson['coach_name']) ?></td>
                                <td><?= htmlspecialchars($lesson['booked_count']) ?></td>

                                <td>
                                    <a href="?action=editLesson&id=<?= $lesson['id'] ?>">
                                        Editar
                                    </a>
                                    |
                                    <a href="?action=deleteLesson&id=<?= $lesson['id'] ?>"
                                       onclick="return confirm('¿Estás seguro?')">
                                        Eliminar
                                    </a>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>