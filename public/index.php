<?php
// public/index.php
require_once __DIR__ . '/../app/config/db.php';

// Capturamos la URL (ej: /alumnos, /clases)
$route = $_GET['url'] ?? 'home';


switch ($route) {
    case 'home':
        require_once __DIR__ . '/../app/controllers/HomeController.php';
        (new HomeController())->index();
        break;

    case 'login': // Vista del formulario
        require_once __DIR__ . '/../app/controllers/UsuarioController.php';
        (new UsuarioController())->showLogin();
        break;

    case 'auth': // Proceso de validación (Fetch)
        require_once __DIR__ . '/../app/controllers/UsuarioController.php';
        (new UsuarioController())->auth();
        break;

    case 'register':
        require_once __DIR__ . '/../app/controllers/UsuarioController.php';
        (new UsuarioController())->register();
        break;

    case 'logout':
        session_start();
        session_destroy();
        header('Location: ?url=login');
        break;

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}