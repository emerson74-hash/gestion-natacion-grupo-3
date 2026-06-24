<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow-sm coach-card">

                <?php
                $img = $profile['profile_image'] ?? 'default-profile.png';
                $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);
                ?>

              
                 <!-- CABECERA -->
                    <div class="card-header coach-header">
                        <div class="d-flex align-items-center gap-3">
            
                    <img
                        src="<?= $src ?>"
                        alt="Foto de perfil"
                        class="rounded-circle border"
                        style="width:95px; height:95px; object-fit:cover;"
                        id="preview-img">

                    <div class="text-start">
                        <h5 class="mb-0">
                            <?= htmlspecialchars(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? '')) ?>
                        </h5>
                        <small class="text-light">
                            <?= htmlspecialchars($profile['email'] ?? '') ?>
                        </small>
                    </div>

                </div>
                    </div>
                <div class="card-body p-4">

                    <!-- FORMULARIO -->
                    <form
                        id="profile-form"
                        action="<?= _URL ?>/?url=swimmer/update-profile"
                        method="POST"
                        enctype="multipart/form-data"
                        novalidate>

                        <div class="row g-3">

                            <!-- NOMBRE -->
                            <div class="col-md-6">
                                <label for="first_name" class="form-label fw-semibold">Nombre <span class="text-danger">*</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control"
                                    value="<?= htmlspecialchars($profile['first_name'] ?? '') ?>" required>
                                <div class="invalid-feedback">Ingrese su nombre.</div>
                            </div>

                            <!-- APELLIDO -->
                            <div class="col-md-6">
                                <label for="last_name" class="form-label fw-semibold">Apellido <span class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control"
                                    value="<?= htmlspecialchars($profile['last_name'] ?? '') ?>" required>
                                <div class="invalid-feedback">Ingrese su apellido.</div>
                            </div>

                            <!-- TELEFONO -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    value="<?= htmlspecialchars($profile['phone'] ?? '') ?>"
                                    placeholder="Ej: 1153170256"
                                    pattern="[0-9]{8,15}" maxlength="15" required>
                                <div class="invalid-feedback">Ingrese un teléfono válido.</div>
                            </div>

                            <!-- FECHA -->
                            <div class="col-md-6">
                                <label for="birth_date" class="form-label fw-semibold">Fecha de nacimiento</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control"
                                    max="<?= date('Y-m-d') ?>"
                                    value="<?= htmlspecialchars($profile['birth_date'] ?? '') ?>">
                            </div>

                            <!-- NUEVA CONTRASEÑA -->
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">Nueva contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Dejar en blanco para mantener la actual">
                                    <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- CONFIRMAR CONTRASEÑA -->
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label fw-semibold">Confirmar contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                                        placeholder="Repetí la nueva contraseña">
                                    <button type="button" class="btn btn-outline-secondary" id="toggle-confirm">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- FOTO -->
                            <div class="col-12">
                                <label for="profile_image" class="form-label fw-semibold">Foto de perfil</label>
                                <input type="file" id="profile_image" name="profile_image" class="form-control"
                                    accept="image/jpg,image/jpeg,image/png,image/gif">
                                <div class="form-text">
                                    JPG, JPEG, PNG y GIF. Máx 2 MB.
                                </div>
                            </div>

                            <!-- PREVIEW -->
                            <div class="col-12 mt-2" style="max-width: 300px;">
                                <img id="crop-preview" style="max-width:100%; max-height:250px; display:none;">
                            </div>

                        </div>

                        <!-- BOTONES -->
                        <div class="mt-4 d-flex justify-content-center gap-3 flex-wrap">

                            <button type="submit" class="btn btn-info text-white profile-btn" id="save-btn">
                                <span class="spinner-border spinner-border-sm d-none me-2" id="save-spinner"></span>
                                Guardar cambios
                            </button>

                            <a href="<?= _URL ?>/?url=swimmer/dashboard"
                                class="btn btn-info text-white profile-btn">
                                Cancelar
                            </a>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<div style="height:80px;"></div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>