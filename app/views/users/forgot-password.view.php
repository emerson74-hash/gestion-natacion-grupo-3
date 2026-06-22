<?php include __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card">

                <div class="card-header text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-shield-lock"></i>
                        Recuperar contraseña
                    </h4>
                </div>

                <div class="card-body p-4">

                    <p class="text-center mb-4">
                        Ingresá tu correo electrónico y te enviaremos un enlace para generar una nueva contraseña.
                    </p>

                    <form id="formForgotPassword"
                          action="?url=send-reset"
                          method="POST">

                        <div class="mb-3">
                            <label class="form-label">
                                Email registrado
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="ejemplo@correo.com"
                                   required>
                        </div>

                        <div class="text-center mt-4">

                            <button type="submit"
                                    class="register-btn">
                                Enviar enlace de recuperación
                            </button>

                        </div>

                    </form>

                </div>

                <div class="card-footer text-center">

                    <a href="?url=login">
                        <i class="bi bi-arrow-left"></i>
                        Volver al login
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>