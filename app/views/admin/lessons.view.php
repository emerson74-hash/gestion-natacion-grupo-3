<?php include __DIR__ . '/../users/layout/header.php'; ?>


<div class="container mt-4">


<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

    <h2 class="mb-3">Gestión de Clases</h2>

    <a href="?url=admin&section=create-lesson"
       class="btn-admin btn-primary-admin mb-3">
    <i class="bi bi-plus-lg"></i> Agregar clase
    </a>

    <div class="card shadow-sm mx-auto" style="max-width: 1100px;">
        <div class="card-body">

                <div class="table-responsive-custom">
                   <table class="table-modern">

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
                                    <div class="actions">
                                <a href="?url=admin&section=edit-lesson&id=<?= $lesson['id'] ?>"
                                class="btn-admin btn-warning-admin">
                                Editar
                                </a>

                                <a href="?url=admin&section=delete-lesson&id=<?= $lesson['id'] ?>"
                                class="btn-admin btn-danger-admin btn-sm btn-delete"
                                >
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
<script>
document.querySelectorAll('.btn-delete').forEach(button => {

    button.addEventListener('click', function(e) {

        e.preventDefault();

        const url = this.href;

        Swal.fire({
            title: '¿Eliminar entrenador?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {

            if (result.isConfirmed) {
                window.location.href = url;
            }

        });

    });

});
</script>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>