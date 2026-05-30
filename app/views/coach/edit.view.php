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

                <div class="row">
                    <div class="card-body col-md-3">


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
                            <input type="text" class="form-control" id="nueva_especialidad" name="nueva_especialidad"
                                value="<?= htmlspecialchars(
                                    ($_SESSION['specialty'] ?? '-')

                                ) ?>">
                        </div>

                        <a href="?url=coach/edit" class="btn text-light colorsitoPiola">
                            Guardar cambios
                        </a>

                    </div>
                    <div class="card-body col-md-3 p-0" style="height: 200px; overflow-hidden;">

                        <?php
                        $foto = $_SESSION['profile_image'] ?? 'default-profile.png';
                        $rutaFoto = Env::get('ASSET_URL') . "/img/uploads/profiles/" . $foto;
                        ?>

                        <img src="<?= $rutaFoto ?>" class="w-100 h-100 object-fit-cover object-position-center">

                    </div>
                </div>



            </div>

        </div>

    </div>




</div>








<?php include __DIR__ . '/../users/layout/footer.php'; ?>