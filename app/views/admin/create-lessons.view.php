<?php include __DIR__ . '/../users/layout/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6">

            <div class="card p-5">

                <h1 class="text-center mb-4">
                    Crear Clase 📚
                </h1>

                <form 
                method="POST" 
                action="?url=admin&section=store-lesson"
                enctype="multipart/form-data"
                >


                <div class="col-md-6 mb-3">
                <label>Nivel</label>

                <select name="level" class="form-control" required>
                <option value="">Seleccione un nivel</option>
                <option value="Inicial">Inicial</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Experto">Experto</option>
              </select>
            </div>

                <div class="row">
                <div class="col-md-6 mb-3">
                <label>Día</label>
                <select name="day_of_week" class="form-control">
                <option>Lunes</option>
                <option>Martes</option>
                <option>Miércoles</option>
                <option>Jueves</option>
                <option>Viernes</option>
                <option>Sábado</option>
            </select>
        </div>
</div>

        <div class="col-md-6 mb-3">
            <label>Hora inicio</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Hora fin</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Capacidad</label>
            <input type="number" name="capacity" class="form-control" value="20">
        </div>

        <div class="col-md-6 mb-3">
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
    
    </div>

</div>

<?php include __DIR__ . '/../users/layout/footer.php'; ?>