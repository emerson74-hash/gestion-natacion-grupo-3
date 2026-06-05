<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

    <h2 class="mb-0">Gestión de Entrenadores</h2>

    <a href="?url=admin&section=create-coach"
       class="btn-admin btn-primary-admin">
        <i class="bi bi-plus-lg"></i>
        Agregar entrenador
    </a>

</div>

   <div class="card shadow-sm mx-auto">
    <div class="card-body">

            <table class="table table-hover align-middle">
            <div class="table-responsive-custom">
             <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Nacimiento</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Accion</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach(($coaches ?? []) as $coach): ?>

                        <tr>

                            

                            <td>
                                <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                            </td>

                            <td>
                                <?= $coach['birth_date'] ?>
                            </td>

                            <td>
                                <?= $coach['phone'] ?>
                            </td>

                            <td>
                                <?= $coach['email'] ?>
                            </td>

                            <td>
                                <?= $coach['specialty'] ?>
                            </td>

                            <td>

                                <div class="actions">

                                 <a href="?url=admin&section=edit-coach&id=<?= $coach['user_id'] ?>"
                                 class="btn-admin btn-warning-admin">
                                 Editar
                                 </a>

                                 <a href="?url=admin&section=delete-coach&id=<?= $coach['user_id'] ?>"
                                 class="btn-admin btn-danger-admin btn-delete">
                                 Eliminar
                                 </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

                </div>
                    </table>
            </table>

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