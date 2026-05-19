<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="bg-white p-5 rounded shadow-sm">

    <div class="d-flex align-items-center gap-3 mb-4">
        <?php
            // Tomamos la imagen guardada en la base de datos
            // Si no tiene foto, usamos una por defecto
            $img = $profile['profile_image'] ?? 'default-profile.png';

            // Armamos la ruta completa de la imagen
            // Ahora todas las fotos están en /profiles/
            $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);
        ?>

        <!-- Foto del usuario -->
        <img src="<?= $src ?>"
             alt="Foto de perfil"
             class="rounded-circle border"
             style="width:80px; height:80px; object-fit:cover;"
             id="preview-img">

        <!-- Nombre y email -->
        <div>
            <h2 class="mb-0">
                <?= htmlspecialchars(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? '')) ?>
            </h2>

            <small class="text-muted">
                <?= htmlspecialchars($profile['email'] ?? '') ?>
            </small>
        </div>
    </div>

    <hr>

    <!-- Acá mostramos mensajes de éxito o error -->
    <div id="profile-alert" class="alert d-none" role="alert"></div>

    <!-- Formulario para actualizar el perfil -->
    <form id="profile-form" enctype="multipart/form-data" novalidate>

        <div class="row g-3">

            <!-- Campo teléfono -->
            <div class="col-md-6">
                <label for="phone" class="form-label fw-semibold">
                    Teléfono <span class="text-danger">*</span>
                </label>

                <input type="tel"
                       id="phone"
                       name="phone"
                       class="form-control"
                       value="<?= htmlspecialchars($profile['phone'] ?? '') ?>"
                       required>

                <!-- Mensaje de validación -->
                <div class="invalid-feedback">
                    El teléfono es obligatorio.
                </div>
            </div>

            <!-- Campo fecha de nacimiento -->
            <div class="col-md-6">
                <label for="birth_date" class="form-label fw-semibold">
                    Fecha de nacimiento
                </label>

                <input type="date"
                       id="birth_date"
                       name="birth_date"
                       class="form-control"
                       value="<?= htmlspecialchars($profile['birth_date'] ?? '') ?>">
            </div>

            <!-- Campo para subir nueva foto -->
            <div class="col-12">
                <label for="profile_image" class="form-label fw-semibold">
                    Actualizar foto de perfil
                </label>

                <input type="file"
                       id="profile_image"
                       name="profile_image"
                       class="form-control"
                       accept="image/jpg,image/jpeg,image/png,image/gif">

                <div class="form-text">
                    Formatos aceptados: JPG, PNG, GIF.
                </div>
            </div>

        </div>

        <!-- Botones -->
        <div class="mt-4">

            <!-- Botón guardar -->
            <button type="submit" class="btn btn-primary px-4" id="save-btn">

                <!-- Spinner de carga -->
                <span class="spinner-border spinner-border-sm d-none me-2"
                      id="save-spinner"></span>

                Guardar cambios
            </button>

            <!-- Botón cancelar -->
            <a href="<?= _URL ?>/?url=swimmer/dashboard"
               class="btn btn-outline-secondary ms-2">
                Cancelar
            </a>

        </div>

    </form>
</div>

<script>
(function () {

    'use strict';

    // Tomamos elementos del HTML para trabajar con JS
    const form     = document.getElementById('profile-form');
    const alertBox = document.getElementById('profile-alert');
    const saveBtn  = document.getElementById('save-btn');
    const spinner  = document.getElementById('save-spinner');
    const preview  = document.getElementById('preview-img');

    // =========================
    // PREVIEW DE IMAGEN
    // =========================

    // Cuando el usuario selecciona una imagen
    // mostramos la preview sin recargar la página
    document.getElementById('profile_image').addEventListener('change', function () {

        const file = this.files[0];

        // Verificamos que sea una imagen
        if (file && file.type.startsWith('image/')) {

            // Cambiamos la imagen actual por la nueva
            preview.src = URL.createObjectURL(file);
        }
    });

    // =========================
    // ALERTAS
    // =========================

    // Muestra mensajes arriba del formulario
    // success = verde
    // warning = amarillo
    // error = rojo
    function showAlert(type, message) {

        const map = {
            success: 'success',
            warning: 'warning',
            error  : 'danger'
        };

        alertBox.className = 'alert alert-' + (map[type] ?? 'info');
        alertBox.textContent = message;

        // Hacemos visible la alerta
        alertBox.classList.remove('d-none');

        // Subimos automáticamente arriba
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // =========================
    // LOADING
    // =========================

    // Bloquea el botón mientras se procesa
    // y muestra el spinner de carga
    function setLoading(on) {

        saveBtn.disabled = on;

        spinner.classList.toggle('d-none', !on);
    }

    // =========================
    // VALIDACIÓN
    // =========================

    // Validamos que el teléfono no esté vacío
    function validate() {

        const phone = document.getElementById('phone');

        if (!phone.value.trim()) {

            phone.classList.add('is-invalid');
            return false;
        }

        phone.classList.remove('is-invalid');

        return true;
    }

    // =========================
    // ENVÍO DEL FORMULARIO
    // =========================

    // Enviamos el formulario con AJAX
    // para evitar recargar la página
    form.addEventListener('submit', async function (e) {

        // Evita el submit normal
        e.preventDefault();

        // Si falla la validación, cortamos
        if (!validate()) return;

        // Activamos loading
        setLoading(true);

        try {

            // Enviamos datos al controlador
            const res = await fetch('<?= _URL ?>/?url=swimmer/update-profile', {
                method: 'POST',
                body: new FormData(form)
            });

            // Convertimos la respuesta a JSON
            const data = await res.json();

            // Mostramos el mensaje recibido
            showAlert(data.status, data.message);

        } catch {

            // Error de conexión
            showAlert('error', 'Error de conexión. Intentá de nuevo.');

        } finally {

            // Sacamos loading siempre
            setLoading(false);
        }
    });

})();
</script>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>