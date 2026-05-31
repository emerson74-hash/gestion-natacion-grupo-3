<?php include __DIR__ . '/../users/layout/header.php'; ?>

<div class="container mt-4">

    <h2>Crear Clase</h2>

    <form method="POST" action="?url=admin&section=store-lesson">

        <div class="mb-3">
            <label>Nivel</label>
            <input type="text" name="level" class="form-control" required>
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
            <label>Hora inicio</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Hora fin</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacity" class="form-control" value="20">
        </div>

        <div class="mb-3">
            <label>Entrenador</label>
            <select name="profile_id" class="form-control">
                <?php foreach ($coaches as $coach): ?>
                    <option value="<?= $coach['profile_id'] ?>">
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
            Crear clase
        </button>

    </form>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>