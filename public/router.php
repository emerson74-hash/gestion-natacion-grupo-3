<?php

/**
 * EL ENRUTADOR ( ROUTER ) - Front Controller Pattern
 * Este archivo es el único punto de entrada a la lógica del servidor.
 * Su función es leer la intención del usuario ( vía URL ) y delegar el
 * trabajo al controlador correspondiente.
 */

// Cargamos el núcleo del sistema una sola vez
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/core/Env.php';
require_once __DIR__ . '/../app/core/BaseController.php';

/**
 * 1. CAPTURA DE LA INTENCIÓN
 * Usamos el parámetro 'url' definido en el .htaccess o pasado por GET.
 * Si no hay ruta ( página de inicio ), por defecto vamos a 'home'.
 */
$route = $_GET['url'] ?? 'home';

/**
 * 2. DESPACHO DE RUTAS ( DISPATCHER )
 * El switch actúa como una tabla de decisiones.
 * Cada case representa una URL posible del sistema.
 */
switch ($route) {

    // --- VISTA PRINCIPAL ---
    case 'home':
        // Mostramos la página de inicio
        require_once __DIR__ . '/../app/controllers/HomeController.php';
        (new HomeController())->index();
        break;

    // --- MÓDULO DE USUARIOS Y AUTENTICACIÓN ---
    // Agrupamos rutas relacionadas para evitar repetir el require_once
    case 'login':
    case 'authenticate':
    case 'register':
    case 'forgot-password':
    case 'send-reset':
    case 'reset-password':
    case 'update-password':
        require_once __DIR__ . '/../app/controllers/UserController.php';
        $controller = new UserController();

        /**
         * Ejecución del método según la acción solicitada.
         * Separamos la visualización ( GET ) de la lógica de procesamiento ( POST ).
         */
        if ($route === 'login')
            $controller->showLogin();
        if ($route === 'authenticate')
            $controller->authenticate();
        if ($route === 'register')
            $controller->register();
        if ($route === 'forgot-password')
            $controller->forgotPassword();
        if ($route === 'send-reset')
            $controller->sendReset();
        if ($route === 'reset-password')
            $controller->showResetForm();
        if ($route === 'update-password')
            $controller->updatePassword();
        break;

    // --- MÓDULO COACH ---
    // Agrupa todas las rutas del rol Coach ( role_id = 2 )
    case 'coach/dashboard':
    case 'coach/profile':
        require_once __DIR__ . '/../app/controllers/CoachController.php';
        $controller = new CoachController();

        // Ejecutamos el método que corresponde a la ruta pedida
        if ($route === 'coach/dashboard')
            $controller->dashboard();
        if ($route === 'coach/profile')
            $controller->profile();
        break;

    // --- MÓDULO ADMIN ---
    // Agrupa todas las rutas del rol Administrador ( role_id = 1 )
    case 'admin/dashboard':
        require_once __DIR__ . '/../app/controllers/AdminController.php';
        (new AdminController())->dashboard();
        break;

    // --- MÓDULO SWIMMER ---
    // Agrupa todas las rutas del rol Swimmer ( role_id = 3 )
    case 'swimmer/dashboard':
    case 'swimmer/profile':
    case 'swimmer/update-profile':
    case 'swimmer/lessons':
    case 'swimmer/book':
    case 'swimmer/cancel-booking':
        require_once __DIR__ . '/../app/controllers/SwimmerController.php';
        $controller = new SwimmerController();

        // Ejecutamos el método que corresponde a la ruta pedida
        if ($route === 'swimmer/dashboard')
            $controller->dashboard();
        if ($route === 'swimmer/profile')
            $controller->profile();
        if ($route === 'swimmer/update-profile')
            $controller->updateProfile();
        if ($route === 'swimmer/lessons')
            $controller->lessons();
        if ($route === 'swimmer/book')
            $controller->book();
        if ($route === 'swimmer/cancel-booking')
            $controller->cancelBooking();
        break;

    // --- SEGURIDAD: CIERRE DE SESIÓN ---
    case 'logout':
        /**
         * Para destruir una sesión, primero debemos estar seguros de que
         * el sistema sabe de su existencia ( iniciada previamente en index.php ).
         */
        // Vaciamos el array de sesión por seguridad
        $_SESSION = [];
        // Eliminamos el archivo de sesión en el servidor
        session_destroy();
        // Redirigimos al Login para forzar una nueva autenticación
        header('Location: ?url=login');
        exit;

    // --- MANEJO DE ERRORES ---
    default:
        /**
         * Si el usuario intenta acceder a una ruta que no definimos arriba,
         * devolvemos un código de estado 404 ( Not Found ).
         */
        http_response_code(404);
        echo 'Error 404: La página "' . htmlspecialchars($route) . '" no existe en este sistema.';
        break;
}