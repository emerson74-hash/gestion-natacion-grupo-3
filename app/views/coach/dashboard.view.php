<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="bg-white p-5 rounded shadow-sm">

                <h1>Bienvenido, Coach</h1>
                <p class="lead">Este es el panel administrativo de la escuela.</p>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Ver calendario de clases</h5>
                                <a href="?url=coach/lessons" class="btn btn-primary">
                                    acceder
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Editar perfil</h5>
                                <a href="?url=coach/profile" class="btn btn-primary">
                                    acceder
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                

            </div>

        </div>

    </div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>