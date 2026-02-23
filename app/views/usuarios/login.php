<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="mb-0">Acceso Escuela de Natación</h4>
            </div>
            <div class="card-body p-4">
                <form id="loginForm" novalidate>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="tu@email.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Contraseña</label>
                        <input type="password" name="password" class="form-control" required placeholder="********">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Ingresar</button>

                    <div class="text-center">
                        <p class="mb-1">
                            <a href="?url=forgot-password" class="text-decoration-none text-muted small">¿Olvidaste tu
                                contraseña?</a>
                        </p>
                        <p class="mb-0">
                            ¿Sos nuevo? <a href="?url=register" class="text-decoration-none fw-bold">Registrate acá</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="module" src="js/modules/auth.js"></script>

<?php include __DIR__ . '/../layout/footer.php'; ?>