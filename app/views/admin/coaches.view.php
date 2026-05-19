<?php include __DIR__ . '/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion de Entrenadores</h1>

        <a href="?url=admin/create-coach" class="btn btn-primary">
            + Agregar entrenador
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Accion</th>
                    </tr>
                </thead>

                <tbody>

                
                    <?php foreach(($coaches ?? []) as $coach): ?>

                        <tr>

                            <td class="text-center fs-3">
                                👤
                            </td>

                            <td>
                                <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>
                            </td>

                            <td>
                                <?= $coach['email'] ?>
                            </td>

                            <td>
                                <?= $coach['specialty'] ?>
                            </td>

                            <td>

                                <a 
                                    href="?url=admin/edit-coach&id=<?= $coach['id'] ?>" 
                                    class="btn btn-warning btn-sm"
                                >
                                    Editar
                                </a>

                                <a 
                                    href="?url=admin/delete-coach&id=<?= $coach['id'] ?>" 
                                    class="btn btn-danger btn-sm"
                                >
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

<?php include __DIR__ . '/footer.php'; ?>