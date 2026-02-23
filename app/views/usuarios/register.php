<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h2 class="h4 mb-0"><?= $titulo ?></h2>
                </div>
                <div class="card-body p-4">
                    <form id="registerForm" action=" ?url=register" method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Nombre</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Apellido</label>
                                <input type="text" name="apellido" class="form-control" placeholder="Ej: Perez"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Teléfono de Contacto</label>
                                <input type="text" name="telefono" class="form-control" placeholder="11 2233 4455">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="fw-bold">Contraseña de Acceso</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="?url=home" class="btn btn-outline-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary px-5">Confirmar Registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<script type="module" src="js/modules/auth.js"></script>