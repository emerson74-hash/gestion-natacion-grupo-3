<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header text-center coach-header">
                    <h4>Mi Perfil</h4>
                </div>

                <div class="card-body">
                    <form id="formEdit" action="?url=coach/updateProfile" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nuevo_nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre"
                                           value="<?= htmlspecialchars($_SESSION['first_name'] ?? '-') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nuevo_apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="nuevo_apellido" name="nuevo_apellido"
                                           value="<?= htmlspecialchars($_SESSION['last_name'] ?? '-') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nueva_especialidad" class="form-label">Especialidad</label>
                                    <input type="text" class="form-control" id="nueva_especialidad" name="nueva_especialidad"
                                           value="<?= htmlspecialchars($_SESSION['specialty'] ?? '-') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nueva_contraseña" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="nueva_contraseña" name="nueva_contraseña">
                                    <small class="text-muted">Dejar en blanco para mantener la contraseña actual.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmar_nueva_contraseña" class="form-label">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="confirmar_nueva_contraseña" name="confirmar_nueva_contraseña">
                                </div>

                                <button type="submit" class="btn text-light coach-primary">
                                    Guardar cambios
                                </button>
                            </div>

                            <div class="col-md-6 text-center">
                                <?php
                                $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                                $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                                ?>
                                <img src="<?= $rutaFoto ?>"
                                     class="rounded mb-3"
                                     style="width:150px; height:150px; object-fit:cover;">

                                <div class="mb-3">
                                    <label class="form-label">Cambiar foto de perfil</label>
                                    <input type="file" id="profile_image" name="profile_image"
                                           class="form-control" accept="image/*">
                                    <div class="mt-3">
                                        <img id="preview" style="max-width:100%; display:none;">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>