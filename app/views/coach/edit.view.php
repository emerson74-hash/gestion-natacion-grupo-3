<?php include __DIR__ . '/../layouts/header.php'; ?>

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

                            <!-- COLUMNA IZQUIERDA: datos -->
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text"
                                           class="form-control"
                                           id="first_name"
                                           name="first_name"
                                           value="<?= htmlspecialchars($coach['first_name'] ?? '') ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Apellido</label>
                                    <input type="text"
                                           class="form-control"
                                           id="last_name"
                                           name="last_name"
                                           value="<?= htmlspecialchars($coach['last_name'] ?? '') ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text"
                                           class="form-control"
                                           id="phone"
                                           name="phone"
                                           value="<?= htmlspecialchars($coach['phone'] ?? '') ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Fecha de nacimiento</label>
                                    <input type="date"
                                           class="form-control"
                                           id="birth_date"
                                           name="birth_date"
                                           value="<?= htmlspecialchars($coach['birth_date'] ?? '') ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Especialidad</label>
                                    <select class="form-select" id="specialty" name="specialty">
                                        <option value="Natación inicial"
                                            <?= ($coach['specialty'] ?? '') === 'Natación inicial' ? 'selected' : '' ?>>
                                            Natación Inicial
                                        </option>
                                        <option value="Natación intermedia"
                                            <?= ($coach['specialty'] ?? '') === 'Natación intermedia' ? 'selected' : '' ?>>
                                            Natación Intermedia
                                        </option>
                                        <option value="Natación avanzada"
                                            <?= ($coach['specialty'] ?? '') === 'Natación avanzada' ? 'selected' : '' ?>>
                                            Natación Avanzada
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Contraseña nueva <small class="text-muted">(opcional)</small></label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control"
                                               id="nueva_contraseña"
                                               name="nueva_contraseña">
                                        <button type="button" class="btn btn-outline-secondary"
                                                data-toggle-password data-target="nueva_contraseña">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirmar contraseña</label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control"
                                               id="confirmar_nueva_contraseña"
                                               name="confirmar_nueva_contraseña">
                                        <button type="button" class="btn btn-outline-secondary"
                                                data-toggle-password data-target="confirmar_nueva_contraseña">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn text-light coach-primary">
                                        Guardar cambios
                                    </button>
                                    <a href="javascript:history.back()" class="btn text-light coach-primary">
                                        Cancelar
                                    </a>
                                </div>
                            </div>

                            <!-- COLUMNA DERECHA: foto -->
                            <div class="col-md-6 text-center">
                                <?php
                                    $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                                    $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                                ?>
                                <img id="current_profile_image"
                                     src="<?= $rutaFoto ?>"
                                     class="rounded mb-3"
                                     style="width:150px; height:150px; object-fit:cover;">

                                <div class="mb-3">
                                    <label class="form-label">Cambiar foto de perfil</label>
                                    <input type="file" id="profile_image" name="profile_image"
                                           class="form-control" accept="image/*">
                                </div>

                                <!-- Contenedor fijo para que el cropper no baje el layout -->
                                <div id="cropper-wrapper"
                                     style="width:100%; max-height:250px; overflow:hidden; display:none;">
                                    <img id="preview" style="max-width:100%;">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>