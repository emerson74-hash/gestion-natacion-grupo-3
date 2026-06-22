<?php include __DIR__ . '/../layouts/header.php'; ?>


<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/app.css">

<div class="container mt-4">
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">

    <h2 class="mb-0">Gestión de Entrenadores</h2>

    <div class="d-flex gap-2 ms-auto">

        <a href="?url=admin&section=dashboard"
           class="btn-admin btn-secondary-admin">
            Volver al panel
        </a>

        <a href="?url=admin&section=create-coach"
           class="btn-admin btn-primary-admin">
            <i class="bi bi-plus-lg"></i>
            Agregar entrenador
        </a>

    </div>

</div>

    <div class="card shadow-sm mx-auto">
        <div class="card-body">

            <div class="table-responsive-custom">
                <table id="tablaClases" class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de nacimiento</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Especialidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach (($coaches ?? []) as $coach): ?>
                            <tr>
                                <td>
                                    <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                                </td>

                                <td>
                                    <?= (!empty($coach['birth_date']) && $coach['birth_date'] !== '0000-00-00')
                                        ? date('d/m/Y', strtotime($coach['birth_date']))
                                        : '-' ?>
                                </td>

                                <td>
                                    <?= $coach['phone'] ?? '-' ?>
                                </td>

                                <td>
                                    <?= $coach['email'] ?? '-' ?>
                                </td>

                                <td>
                                    <?= $coach['specialty'] ?? '-' ?>
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

                </table>
            </div>

        </div>
    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>