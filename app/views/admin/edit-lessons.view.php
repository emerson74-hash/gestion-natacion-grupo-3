<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6">

            <div class="card p-4">

                <h1 class="text-center mb-4">
                  Editar Clase
                </h1>

                <form method="POST"
                      action="?url=admin&section=update-lesson">

            <input type="hidden"
             name="id"
             value="<?= $lesson['id'] ?>">

            <div class="row">
            <div class="col-md- 6 mb-3">
            <label>Nivel</label>

                <select name="level" class="form-control" required>
                <option value="">Seleccione un nivel</option>
                <option value="Inicial">Inicial</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Experto">Experto</option>
              </select>
            </div>

          <div class="col-md-6 mb-3">

         <label>Día</label>
        <select name="day_of_week" class="form-control">
        <option <?= $lesson['day_of_week']=='Lunes' ? 'selected' : '' ?>>
               Lunes
         </option>
                <option <?= $lesson['day_of_week']=='Martes' ? 'selected' : '' ?>>
               Martes
         </option>
         <option <?= $lesson['day_of_week']=='Miércoles' ? 'selected' : '' ?>>
               Miercoles
         </option>
                <option <?= $lesson['day_of_week']=='Jueves' ? 'selected' : '' ?>>
               Jueves
         </option>
                <option <?= $lesson['day_of_week']=='Viernes' ? 'selected' : '' ?>>
                Viernes
        </option>
                <option <?= $lesson['day_of_week']=='Sábado' ? 'selected' : '' ?>>
                Sabado
          </option>
            </select>
            </div>

       <div class="col-md-6 mb-3">

       <label>Hora Inicio</label>

           <input type="time"
            name="start_time"
            value="<?= $lesson['start_time'] ?>"
            class="form-control">

         </div>

       <div class="col-md-6 mb-3">

        <label>Hora Fin</label>

        <input type="time"
       name="end_time"
       value="<?= $lesson['end_time'] ?>"
       class="form-control">

       </div>

        <div class="col-md-6 mb-3">

       <label>Capacidad</label>

       <input type="number"
       name="capacity"
       value="<?= $lesson['capacity'] ?>"
       class="form-control">

        </div>

        <div class="col-md-6 mb-3">

      <label>Entrenador</label>

        <select name="profile_id"
        class="form-control">

<?php foreach($coaches as $coach): ?>

      <option
      value="<?= $coach['profile_id'] ?>"
      <?= $coach['profile_id'] == $lesson['profile_id'] ? 'selected' : '' ?>>

      <?= $coach['first_name'] . ' ' . $coach['last_name'] ?>

     </option>

<?php endforeach; ?>

               </select>

                <div class="d-flex gap-2">

              <!--  <a 
                  href="?url=admin&section=lessons"
                  class="btn btn-secondary w-50"
                >
               
                ← Volver

                </a> -->

              <button 
                type="submit"
                class="btn btn-primary w-100 py-2"
               >
               Guardar cambios
              </button>

   </form>
</div>
</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>