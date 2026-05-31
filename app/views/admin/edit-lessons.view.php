<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container mt-4">

<h2>Editar Clase</h2>

<form method="POST" action="?url=admin&section=update-lesson">

<input type="hidden"
       name="id"
       value="<?= $lesson['id'] ?>">

<div class="mb-3">
    <label>Nivel</label>

    <input type="text"
           name="level"
           class="form-control"
           value="<?= $lesson['level'] ?>">
</div>

<div class="mb-3">

<label>Día</label>
        <select name="day_of_week" class="form-control">
                <option>Lunes</option>
                <option>Martes</option>
                <option>Miercoles</option>
                <option>Jueves</option>
                <option>Viernes</option>
                <option>Sabado</option>
            </select>
            </div>

<div class="mb-3">

       <label>Hora Inicio</label>

           <input type="time"
            name="start_time"
            value="<?= $lesson['start_time'] ?>"
            class="form-control">

</div>

<div class="mb-3">

        <label>Hora Fin</label>

        <input type="time"
       name="end_time"
       value="<?= $lesson['end_time'] ?>"
       class="form-control">

</div>

<div class="mb-3">

       <label>Capacidad</label>

       <input type="number"
       name="capacity"
       value="<?= $lesson['capacity'] ?>"
       class="form-control">

</div>

<div class="mb-3">

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

</div>
     <a href="?url=admin&section=lessons"
     class="btn btn-secondary mw-50">
   ← Volver
   </a>

    <button class="btn btn-success mw-50">
    Guardar Cambios
    </button>

</form>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>