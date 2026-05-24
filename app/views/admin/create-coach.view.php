<?php include __DIR__ . '/header.php'; ?>

<div class="container mt-4">

    <h1>Agregar Entrenador</h1>

    <form method="POST" action="?url=admin&section=store-coach">
        
        <input type="text" name="first_name" placeholder="Nombre" required>
        <input type="text" name="last_name" placeholder="Apellido" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="specialty" placeholder="Especialidad" required>
        <input type="password" name="password" placeholder="Contraseña" required>

        <button type="submit" class="btn btn-success mt-3">
            Guardar
        </button>

    </form>

</div>

<?php include __DIR__ . '/footer.php'; ?>