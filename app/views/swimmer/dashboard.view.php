<?php include __DIR__ . '/../users/layout/header.php'; ?>


<div class="container mt-4">


<div class="bg-white p-4 rounded shadow-sm">



    <!-- =========================
         DATOS USUARIO
    ========================== -->

    <div class="d-flex align-items-center gap-3 mb-4">


        <?php

        $img = $_SESSION['profile_image'] ?? 'default-profile.png';

        $src = _URL . '/public/img/uploads/profiles/' . htmlspecialchars($img);

        ?>


        <img 
            src="<?= $src ?>"
            alt="Foto perfil"
            class="rounded-circle border"
            style="
                width:65px;
                height:65px;
                object-fit:cover;
            "
        >



        <div>


            <h2 class="mb-0">

                Bienvenido nadador
                <?= htmlspecialchars($_SESSION['first_name'] ?? 'Swimmer') ?>

            </h2>


            <small class="text-muted">

                <?= htmlspecialchars($user) ?>

            </small>


        </div>


    </div>




    <!-- =========================
         CARDS ACCESO RAPIDO
    ========================== -->


    <div class="row g-4 swimmer-actions mb-4">



        <!-- PERFIL -->

        <div class="col-md-6">


            <a href="<?= _URL ?>/?url=swimmer/profile"
               class="text-decoration-none">


                <div class="swimmer-card">


                    <div>


                        <h5>
                            Mi Perfil
                        </h5>


                        <p>
                            Actualizá tu teléfono,
                            fecha de nacimiento y foto.
                        </p>


                    </div>


                </div>


            </a>


        </div>





        <!-- CLASES -->


        <div class="col-md-6">


            <a href="<?= _URL ?>/?url=swimmer/lessons"
               class="text-decoration-none">


                <div class="swimmer-card">


                    <div>


                        <h5>
                            Clases Disponibles
                        </h5>


                        <p>
                            Explorá y anotate
                            en el cronograma.
                        </p>


                    </div>


                </div>


            </a>


        </div>



    </div>





    <!-- =========================
         TABLA
    ========================== -->


    <h4 class="mb-3">

        Mis clases inscriptas

    </h4>





    <?php if (empty($myBookings)): ?>



        <div class="alert alert-info">


            Todavía no estás inscripto en ninguna clase.


            <a href="<?= _URL ?>/?url=swimmer/lessons">

                Ver clases disponibles →

            </a>


        </div>




    <?php else: ?>





        <div class="table-responsive swimmer-table">



            <table class="table table-hover table-sm align-middle">



                <thead>


                    <tr>


                        <th>
                            Nivel
                        </th>


                        <th>
                            Día
                        </th>


                        <th>
                            Horario
                        </th>


                        <th>
                            Profesor
                        </th>


                    </tr>


                </thead>





                <tbody>




                <?php


                $dayLabels = [

                    'Monday'=>'Lunes',
                    'Tuesday'=>'Martes',
                    'Wednesday'=>'Miércoles',
                    'Thursday'=>'Jueves',
                    'Friday'=>'Viernes',
                    'Saturday'=>'Sábado'

                ];



                foreach($myBookings as $b):

                ?>




                    <tr>



                        <td>

                            <?= htmlspecialchars($b['level'] ?? '—') ?>

                        </td>





                        <td>

                            <?= htmlspecialchars(
                                $dayLabels[$b['day_of_week']]
                                ?? $b['day_of_week']
                            ) ?>

                        </td>





                        <td>


                            <?= htmlspecialchars(substr($b['start_time'],0,5)) ?>


                            -


                            <?= htmlspecialchars(substr($b['end_time'],0,5)) ?>


                        </td>





                        <td>

                            <?= htmlspecialchars($b['coach_name']) ?>

                        </td>




                    </tr>




                <?php endforeach; ?>





                </tbody>



            </table>



        </div>




    <?php endif; ?>





</div>


</div>




<?php include __DIR__ . '/../users/layout/footer.php'; ?>