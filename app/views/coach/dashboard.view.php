<?php include __DIR__ . '/../users/layout/header.php'; ?>


<link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/assets/css/style.css">


<div class="container  ">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

                <h1>Bienvenido, Coach</h1>
                <p class="lead">Este es el panel administrativo de la escuela.</p>

                <hr>

                <div class="row">
                    <div class="col-md-6 ">
                        <a href="?url=coach/lessons"
                            class="card text-white colorsitoPiola mb-3 text-decoration-none d-block">
                            <div class="card-body text-center">
                                <h5 class="card-title">Ver calendario de clases</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="?url=coach/profile"
                            class="card text-white colorsitoPiola mb-3 text-decoration-none d-block">
                            <div class="card-body text-center">
                                <h5 class="card-title">Editar datos personales</h5>
                            </div>
                        </a>




                    </div>

                </div>
                <hr>
                <div class="row">


                </div>



            </div>

        </div>

    </div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>