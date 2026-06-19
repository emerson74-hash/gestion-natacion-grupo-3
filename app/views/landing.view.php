<!-- app/views/landing.view.php -->

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Swim Learn | Escuela de Natación</title> 

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <!-- bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/landing.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<!-- ================= HERO ================= -->
<section class="hero">

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

        <div class="container">

            <!--  SOLO SE AGREGÓ EL LOGO -->
            <a class="navbar-brand logo-text" href="?url=landing">

                <img
                    src="/Gestion-Natacion-Grupo-3/public/imglogo/logo.png"
                    alt="Swim Learn"
                    class="landing-logo">

                Swim Learn
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-4">

                    <li class="nav-item">
                        <a class="nav-link" href="#nosotros">
                            Acerca de Nosotros
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#niveles">
                            Niveles
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">
                            Contacto
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn login-btn" href="?url=login">
                            Iniciar sesión
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- HERO CONTENT -->
    <div class="hero-content">

        <div class="hero-top-line"></div>

        <div class="hero-title-wrapper">

            <img
                src="/Gestion-Natacion-Grupo-3/public/imglogo/logo.png"
                alt="Swim Learn"
                class="hero-logo">

            <h1 class="hero-title">
                SWIM LEARN
            </h1>

        </div>

        <p class="hero-subtitle">
            ESCUELA DE NATACIÓN
        </p>

        <div class="hero-bottom-line"></div>

        <a href="?url=register" class="hero-button">
            Inscribite ya
        </a>

    </div>

</section>

<!-- ================= NIVELES ================= -->
<section id="niveles" class="info-section">

    <div class="container">

        <h2 class="section-title">
            Niveles
        </h2>

        <div class="info-cards">

            <!-- CARD 1 -->
            <div class="info-card">

                <h3>Inicial</h3>

                <p>
                    <strong>Objetivo:</strong> Familiarizarse con el entorno acuático,
                    ganar confianza y comenzar a moverse libremente en el agua.
                    <br><br>

                    <strong>Aprendizajes clave:</strong>
                    <br>
                    • Flotación cervical y dorsal con material auxiliar.
                    • Control de la respiración: sumergir boca y nariz.
                    • Desplazamientos básicos en posición vertical.
                    • Iniciación a la patada en posición ventral y dorsal.
                    • Introducir voluntariamente la cara en el agua.
                    <br><br>

                    El primer paso para perder el miedo y descubrir lo divertido
                    que es el agua.
                </p>

            </div>

            <!-- CARD 2 -->
            <div class="info-card">

                <h3>Intermedio</h3>

                <p>
                    <strong>Objetivo:</strong> Consolidar la técnica básica de los estilos
                    crol y espalda con buena coordinación.
                    <br><br>

                    <strong>Aprendizajes clave:</strong>
                    <br>
                    • Todos los logros del nivel anterior.
                    • Coordinación de brazos y piernas en crol y espalda.
                    • Respiración lateral en crol.
                    • Flotación dorsal, ventral, vertical y estilo “medusa”.
                    • Control de la posición corporal en inspiración y espiración.
                    • Buceo hasta 5 metros.
                    <br><br>

                    Se adquiere fluidez y ritmo: nadar se convierte
                    en un movimiento natural.
                </p>

            </div>

            <!-- CARD 3 -->
            <div class="info-card">

                <h3>Experto</h3>

                <p>
                    <strong>Objetivo:</strong> Dominar todos los estilos, aumentar potencia
                    y resistencia, y disfrutar la natación como disciplina completa.
                    <br><br>

                    <strong>Aprendizajes clave:</strong>
                    <br>
                    • Todos los logros del nivel anterior.
                    • Dominio técnico de todos los estilos.
                    • Salidas y virajes correctos.
                    • Trabajo de velocidad, coordinación y resistencia.
                    <br><br>

                    El nivel más alto: simboliza la confianza,
                    la técnica y el espíritu del auténtico delfín.
                </p>

            </div>

        </div>

    </div>

</section>

<!-- ================= ACERCA DE NOSOTROS ================= -->
<section id="nosotros" class="about-section">

    <div class="container">

        <h2 class="section-title">
            Quiénes Somos...
        </h2>

        <p class="about-text">

            Swim Learn es una escuela de natación fundada en
            Berazategui en el año 1995.
            Desde hace más de 20 años enseñamos a nadar a niños y adultos, 
            creando una comunidad donde el progreso se mide con sonrisas.
            
            Nuestra misión es ser la escuela de natación más querida y reconocida
            de Buenos Aires por nuestra atención personalizada, calidad humana y 
            resultados visibles.

            Queremos inspirar a cada alumno a superarse con confianza y disfrutar
            del agua como un estilo de vida, para ello contamos con excelente Staff
            de profesores capacitados para brindar una excelente calidad educativa.

            En Swim Learn creemos que el aprendizaje en el agua va 
            mucho más allá de una habilidad física: es una experiencia que
            fomenta confianza, seguridad y diversión.
            
            Acompañamos a cada familia en este proceso con una enseñanza 
            personalizada, cercana y llena de cariño.

        </p>

    </div>

</section>

<!-- ================= CONTACTO ================= -->
<section id="contacto" class="contact-section">
    <?php if (!empty($_SESSION['success'])): ?>
    <div class="container mb-4">
        <div class="alert alert-success text-center">
            <?= $_SESSION['success']; ?>
        </div>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="container mb-4">
        <div class="alert alert-danger text-center">
            <?= $_SESSION['error']; ?>
        </div>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

    <div class="container">

        <div class="contact-header">
            <h2 class="section-title">Contacto</h2>
        </div>

        <div class="contact-container">

            <div class="contact-data">
                <h3>Escuela Swim Learn</h3>
                <p>
                    <i class="fas fa-map-marker-alt me-2 text-white"></i>
                    Calle 149 N° 1881 - Berazategui
                </p>

                <p>
                    <i class="fas fa-phone me-2 text-white"></i>
                    11 5317-0256
                </p>

                <p>
                    <i class="fas fa-envelope me-2 text-white"></i>
                    escueladenatacion@swimlearn.com
                </p>
                    <p class="contact-text">
                    ¿Tenes dudas sobre horarios, niveles o inscripciones?
                    Completa el formulario y nos pondremos en contacto.
                </p>
            </div>

            <div class="contact-form">

                <form method="POST" action="?url=landing/sendContact">
                <input
                    type="text"
                    name="nombre"
                    placeholder="Nombre completo"
                    required>

                <input
                    type="email"
                    name="email"
                    placeholder="Correo electrónico"
                    required>
                                
                    <select name="motivo" required>
                        <option>Motivo de consulta</option>
                        <option>Precios</option>
                        <option>Horarios</option>
                        <option>Inscripciones</option>
                        <option>Otro</option>
                    </select>

                    <textarea
                    name="mensaje"
                    rows="5"
                    placeholder="Escriba su consulta..."
                    required></textarea>

                    <button type="submit">
                        Enviar consulta
                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>