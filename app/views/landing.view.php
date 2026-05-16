<!-- app/views/landing.view.php -->

<!DOCTYPE html>
<html lang="es">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Titulo -->

    <title>Swim Learn | Escuela de Natación</title> 




    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700;800&display=swap" rel="stylesheet">



    <!-- bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">




    <!-- ccs -->
    <link rel="stylesheet" href="/Gestion-Natacion-Grupo-3/public/css/landing.css">

</head>

<body>




<!-- parte principal del hero  -->

<section class="hero">


    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

        <div class="container">



            <!-- logo -->
            <a class="navbar-brand logo-text" href="?url=landing">
                Swim Learn
            </a>




            <!-- boton -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>



            <!-- aca links para acceder del menu -->
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



    <!-- contenido del hero, lineas y titulo de la pagina-->
    <div class="hero-content">

        <!-- Línea superior -->
        <div class="hero-top-line"></div>

        <!-- Título -->
        <h1 class="hero-title">
            SWIM LEARN
        </h1>

        <!-- Subtítulo -->
        <p class="hero-subtitle">
            ESCUELA DE NATACIÓN
        </p>

        <!-- Línea inferior -->
        <div class="hero-bottom-line"></div>

        <!-- Botón -->
        <a href="?url=login" class="hero-button">
            Inscribite ya
        </a>

    </div>

</section>



<!-- Niveles de la escuela-->

<section id="niveles" class="info-section">

    <div class="container">

        <h2 class="section-title">
            Niveles
        </h2>

        <div class="info-cards">



            <!-- Contenido de la card 1 -->
            <div class="info-card">

                <h3>Inicial</h3>

                <p>
                    <strong>Objetivo:</strong> Familiarizarse con el entorno acuático,
                    ganar confianza y comenzar a moverse libremente en el agua.
                    <br><br>

                    <strong>Aprendizajes clave:</strong>
                    <br>
                    • Flotación cervical y dorsal con material auxiliar.
                    <br>
                    • Control de la respiración: sumergir boca y nariz.
                    <br>
                    • Desplazamientos básicos en posición vertical.
                    <br>
                    • Iniciación a la patada en posición ventral y dorsal.
                    <br>
                    • Introducir voluntariamente la cara en el agua.
                    <br><br>

                    El primer paso para perder el miedo y descubrir lo divertido
                    que es el agua.
                </p>

            </div>





            <!-- card 2 contenido -->
            <div class="info-card">

                <h3>Intermedio</h3>

                <p>
                    <strong>Objetivo:</strong> Consolidar la técnica básica de los estilos
                    crol y espalda con buena coordinación.
                    <br><br>

                    <strong>Aprendizajes clave:</strong>
                    <br>
                    • Todos los logros del nivel anterior.
                    <br>
                    • Coordinación de brazos y piernas en crol y espalda.
                    <br>
                    • Respiración lateral en crol.
                    <br>
                    • Flotación dorsal, ventral, vertical y estilo “medusa”.
                    <br>
                    • Control de la posición corporal en inspiración y espiración.
                    <br>
                    • Buceo hasta 5 metros.
                    <br><br>

                    Se adquiere fluidez y ritmo: nadar se convierte
                    en un movimiento natural.
                </p>

            </div>





            <!-- contenido de la card 3 -->
            <div class="info-card">

                <h3>Experto</h3>

                <p>
                    <strong>Objetivo:</strong> Dominar todos los estilos, aumentar potencia
                    y resistencia, y disfrutar la natación como disciplina completa.
                    <br><br>

                    <strong>Aprendizajes clave:</strong>
                    <br>
                    • Todos los logros del nivel anterior.
                    <br>
                    • Dominio técnico de todos los estilos.
                    <br>
                    • Salidas y virajes correctos.
                    <br>
                    • Trabajo de velocidad, coordinación y resistencia.
                    <br><br>

                    El nivel más alto: simboliza la confianza,
                    la técnica y el espíritu del auténtico delfín.
                </p>

            </div>

        </div>

    </div>

</section>




<!-- contenido de acerca de nosotros-->
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



<!-- contenido de contacto -->
<section id="contacto" class="contact-section">

    <div class="container">

        <h2 class="section-title">
            Contacto
        </h2>

        <div class="contact-info">

            <p>
                
                <a
                    href="https://maps.google.com/?q=Calle+149+1881+Berazategui"
                    target="_blank"
                >
                    Calle 149 N° 1881 - Berazategui
                </a>
            </p>

            <p>
                
                <a href="tel:1153170256">
                    11 5317-0256
                </a>
            </p>

            <p>
                
                <a href="mailto:escueladenatacion@swimlearn.com">
                    escueladenatacion@swimlearn.com
                </a>
            </p>

        </div>

    </div>

</section>





<!--bootstrap js-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>