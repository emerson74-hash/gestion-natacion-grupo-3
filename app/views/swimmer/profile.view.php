<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container mt-4">

```
<div class="bg-white p-5 rounded shadow-sm">

    <?php
    $img = $profile['profile_image'] ?? 'default-profile.png';
    $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);
    ?>

    <!-- =========================
         CABECERA PERFIL
    ========================== -->
    <div class="d-flex align-items-center gap-3 mb-4">

        <img
            src="<?= $src ?>"
            alt="Foto de perfil"
            class="rounded-circle border"
            style="width:80px; height:80px; object-fit:cover;"
            id="preview-img">

        <div>

            <h2 class="mb-0">
                <?= htmlspecialchars(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? '')) ?>
            </h2>

            <small class="text-muted">
                <?= htmlspecialchars($profile['email'] ?? '') ?>
            </small>

        </div>

    </div>

    <!-- =========================
         ALERTAS
    ========================== -->
    <div
        id="profile-alert"
        class="alert d-none"
        role="alert">
    </div>

    <!-- =========================
         FORMULARIO
    ========================== -->
    <form
        id="profile-form"
        action="<?= _URL ?>/?url=swimmer/update-profile"
        method="POST"
        enctype="multipart/form-data"
        novalidate>

        <div class="row g-3">

            <!-- TELEFONO -->
            <div class="col-md-6">

                <label
                    for="phone"
                    class="form-label fw-semibold">

                    Teléfono
                    <span class="text-danger">*</span>

                </label>

                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    class="form-control"
                    value="<?= htmlspecialchars($profile['phone'] ?? '') ?>"
                    placeholder="Ej: 1153170256"
                    pattern="[0-9]{8,15}"
                    maxlength="15"
                    required>

                <div class="invalid-feedback">
                    Ingrese un teléfono válido (8 a 15 números).
                </div>

            </div>

            <!-- FECHA -->
            <div class="col-md-6">

                <label
                    for="birth_date"
                    class="form-label fw-semibold">

                    Fecha de nacimiento

                </label>

                <input
                    type="date"
                    id="birth_date"
                    name="birth_date"
                    class="form-control"
                    max="<?= date('Y-m-d') ?>"
                    value="<?= htmlspecialchars($profile['birth_date'] ?? '') ?>">

                <div class="invalid-feedback">
                    La fecha no puede ser futura.
                </div>

            </div>

            <!-- FOTO -->
            <div class="col-12">

                <label
                    for="profile_image"
                    class="form-label fw-semibold">

                    Foto de perfil

                </label>

                <input
                    type="file"
                    id="profile_image"
                    name="profile_image"
                    class="form-control"
                    accept="image/jpg,image/jpeg,image/png,image/gif">

                <div class="form-text">
                    Formatos permitidos: JPG, JPEG, PNG y GIF.
                    Tamaño máximo recomendado: 2 MB.
                </div>

            </div>

            <!-- PREVIEW CROPPER -->
            <div class="col-12 mt-3">

                <img
                    id="crop-preview"
                    style="
                        max-width:100%;
                        max-height:400px;
                        display:none;
                    ">

            </div>

        </div>

        <!-- =========================
             BOTONES
        ========================== -->
        <div class="mt-4">

            <button
                type="submit"
                class="btn btn-info text-white px-4"
                id="save-btn">

                <span
                    class="spinner-border spinner-border-sm d-none me-2"
                    id="save-spinner">
                </span>

                Guardar cambios

            </button>

            <a
                href="<?= _URL ?>/?url=swimmer/dashboard"
                class="btn btn-outline-secondary ms-2">

                Cancelar

            </a>

        </div>

    </form>

</div>
```

</div>

<div style="height:80px;"></div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>
