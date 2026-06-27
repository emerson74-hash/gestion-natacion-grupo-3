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

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nuevo_nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre"
                                        value="<?= htmlspecialchars($_SESSION['first_name'] ?? '-') ?>"                                </div>
                                <div class="mb-3">
                                    <label for="nuevo_apellido" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="nuevo_apellido" name="nuevo_apellido"
                                        value="<?= htmlspecialchars($coach['last_name'] ?? '') ?>"
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text"
                                        class="form-control"
                                        id="telefono"
                                        name="telefono"
                                        value="<?= htmlspecialchars($coach['phone'] ?? '') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Fecha de nacimiento</label>
                                    <input type="date"
                                        class="form-control"
                                        id="birth_date"
                                        name="birth_date"
                                        value="<?= htmlspecialchars($coach['birth_date'] ?? '') ?>">
                                </div>

           

                                    <div class="mb-3">
                                        <label for="nueva_especialidad" class="form-label">Especialidad</label>

                                        <select class="form-select" id="nueva_especialidad" name="nueva_especialidad" required>

                                            <option value="natacion_inicial"
                                                <?= ($coach['specialty'] ?? '') === 'natacion_inicial' ? 'selected' : '' ?>>
                                                Natación Inicial
                                            </option>

                                            <option value="natacion_intermedia"
                                                <?= ($coach['specialty'] ?? '') === 'natacion_intermedia' ? 'selected' : '' ?>>
                                                Natación Intermedia
                                            </option>

                                            <option value="natacion_experto"
                                                <?= ($coach['specialty'] ?? '') === 'natacion_experto' ? 'selected' : '' ?>>
                                                Natación Experto
                                            </option>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contraseña</label>

                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control"
                                                id="password"
                                                name="nueva_contraseña">
                                            <button type="button"
                                            class="btn btn-outline-secondary"
                                            data-toggle-password
                                            data-target="password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    </div>
                                
                                        <div class="mb-3">
                                        <label class="form-label">Confirmar contraseña</label>

                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control"
                                                id="confirm_password"
                                                name="confirmar_nueva_contraseña">

                                        <button type="button"
                                        class="btn btn-outline-secondary"
                                        data-toggle-password
                                        data-target="confirm_password">
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

<?php include __DIR__ . '/../layouts/footer.php'; ?>