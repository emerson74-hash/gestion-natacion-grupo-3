<?php include __DIR__ . '/header.php'; ?>

<div class="container mt-4">

    <h1>Editar Entrenador</h1>

    <form method="POST" action="?url=admin&section=update-coach">

        <input type="hidden" name="id" value="<?= $coach['id'] ?>">

        <input 
            type="text"
            name="first_name"
            value="<?= $coach['first_name'] ?>"
            required
        >

        <input 
            type="text"
            name="last_name"
            value="<?= $coach['last_name'] ?>"
            required
        >

        <input 
            type="email"
            name="email"
            value="<?= $coach['email'] ?>"
            required
        >

        <input 
            type="text"
            name="specialty"
            value="<?= $coach['specialty'] ?>"
            required
        >

        <button type="submit" class="btn btn-success mt-3">
            Guardar cambios
        </button>

    </form>

</div>

<?php include __DIR__ . '/footer.php'; ?>