<?php include __DIR__ . '/../layouts/header.php'; ?>

<link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/auth.css">

<div class="container py-5 mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-5 col-md-7">

            <div class="card shadow border-0">

                <div class="card-header text-white text-center">
                    <h4 class="mb-0">
                        Iniciar Sesión
                    </h4>
                </div>

                <div class="card-body p-4">

                    <form id="formLogin" novalidate>

                        <div class="mb-3">
                            <label class="form-label">
                                Correo Electrónico
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Contraseña
                            </label>

                            <div class="input-group">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    required>

                                <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    id="togglePassword">

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn register-btn">

                                Ingresar

                            </button>

                        </div>

                    </form>

                </div>
                <div class="card-footer text-center">

                    <p class="mb-2">
                        ¿No tienes cuenta?
                        <a href="?url=register">
                            Regístrate aquí
                        </a>
                    </p>

                    <a href="?url=forgot-password">
                        Olvidé mi contraseña
                    </a>

                    <div class="mt-3">
                        <a href="?url=landing" class="btn btn-sm btn-turquesa">
                            Volver al inicio
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>