<?php include __DIR__ . '/../users/layout/header.php'; ?>


<div class="container mt-4">

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">
 

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

    <h2 class="mb-0">Gestión de clases</h2>

    <a href="?url=admin&section=create-lesson"
       class="btn-admin btn-primary-admin">
        <i class="bi bi-plus-lg"></i>
        Agregar clase
    </a>

</div>

    <div class="card shadow-sm mx-auto">
        <div class="card-body">


                <div class="table-responsive-custom">
                
                  <table id="tablaClases" class="table table-hover">

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
                                <td><?= substr($lesson['start_time'], 0, 5) ?></td>
                                <td><?= substr($lesson['end_time'], 0, 5) ?></td>
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

                        <!--Data table-->
<script>
$(document).ready(function () {
    $('#tablaClases').DataTable({
        pageLength: 5,
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
        }
    });
});
</script>

                        <!--Clase creada correctamente-->
                        <?php if (isset($_SESSION['success'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: '¡Éxito!',
    text: '<?= $_SESSION['success'] ?>'
});
</script>
<?php unset($_SESSION['success']); ?>
<?php endif; ?>

                        <!--Error de horarios-->
<?php if (isset($_SESSION['error'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '<?= $_SESSION['error'] ?>'
});
</script>
<?php unset($_SESSION['error']); ?>
<?php endif; ?>

                        <!--Sweet Alerts-->
<script>
document.querySelectorAll('.btn-delete').forEach(button => {

    button.addEventListener('click', function(e) {

        e.preventDefault();

        const url = this.href;

        Swal.fire({
            title: '¿Eliminar clase?',
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