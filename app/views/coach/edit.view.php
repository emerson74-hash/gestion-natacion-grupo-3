<?php include __DIR__ . '/../users/layout/header.php'; ?>
<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">

<!-- AYUDIN container->row->col -->

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header text-center colorsitoPiola text-white">
                    <h4>Mi Perfil</h4>
                </div>
                <form id="profileForm" action="?url=coach/updateProfile" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card-body col-md-3 ms-2">


                            <div class="mb-3">
                                <label for="nuevo_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nuevo_nombre" name="nuevo_nombre" value="<?= htmlspecialchars(
                                    ($_SESSION['first_name'] ?? '-')

                                ) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nuevo_apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="nuevo_apellido" name="nuevo_apellido" value="<?= htmlspecialchars(
                                    ($_SESSION['last_name'] ?? '-')

                                ) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="nueva_especialidad" class="form-label">Especialidad</label>
                                <input type="text" class="form-control" id="nueva_especialidad"
                                    name="nueva_especialidad" value="<?= htmlspecialchars(
                                        ($_SESSION['specialty'] ?? '-')

                                    ) ?>">
                            </div>

                            <button type="submit" class="btn text-light colorsitoPiola">
                                Guardar cambios
                            </button>

                        </div>
                        <div class="card-body col-md-3 text-center me-3">
                            <div>
                                <?php
                                $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                                $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                                ?>

                                <img src="<?= $rutaFoto ?>" class="w-100 h-100 object-fit-cover object-position-center">
                            </div>
                            <div>
                                <div class="mb-3 text-center">
                                    <label class="form-label">Cambiar foto de perfil</label>
                                    <input type="file" id="profile_image" name="profile_image" class="form-control"
                                        accept="image/*">

                                    <div class="mt-3">
                                        <img id="preview" style="max-width:100%; display:none;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


            </div>

        </div>

    </div>




</div>






<script>
    window.cropper = null;

    const imageInput = document.getElementById('profile_image');
    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function (e) {

        const file = e.target.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (event) {

            preview.src = event.target.result;
            preview.style.display = 'block';

            if (window.cropper) {
                window.cropper.destroy();
            }

            window.cropper = new Cropper(preview, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1
            });
        };

        reader.readAsDataURL(file);
    });
    const form = document.getElementById('profileForm');

    form.addEventListener('submit', function (e) {

        if (!window.cropper) {
            return;
        }

        e.preventDefault();

        window.cropper.getCroppedCanvas({
            width: 300,
            height: 300
        }).toBlob(function (blob) {

            const formData = new FormData(form);

            formData.delete('profile_image');

            formData.append(
                'profile_image',
                blob,
                'cropped.png'
            );

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
                .then(() => {
                    window.location.reload();
                });

        }, 'image/png');
    });
</script>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>