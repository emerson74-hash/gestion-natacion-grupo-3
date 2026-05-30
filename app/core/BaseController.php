<?php
// app/controllers/BaseController.php

class BaseController
{

    public function __construct()
    {
        // Iniciamos sesión en el constructor base para que esté disponible en todos lados
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //Al cerrar sesion, ya no muestra datos viejos. Borra el cache.
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

    }

    protected function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            // Si es una petición Fetch, mandamos JSON
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $this->json('error', 'Sesión expirada', '?url=login');
            } else {
                // Si es carga de página normal, redirección directa
                header('Location: ?url=login');
                exit;
            }
        }
    }

    protected function checkRole($roles)
    {
        if (!isset($_SESSION['role_id']) || !in_array($_SESSION['role_id'], (array) $roles)) {
            header('Location: ?url=home');
            exit;
        }
    }


    /**
     * @param string $view  Nombre del archivo ( ej: 'usuarios/register' )
     * @param array  $data  Diccionario de datos para la vista
     */


protected function render($view, $data = [], $layout = null)
{
    extract($data);

    $viewPath = __DIR__ . '/../views/' . $view . '.php';

    if (!file_exists($viewPath)) {
        die("Error: La vista '{$view}' no existe.");
    }

    // si no hay layout = vista normal
    if ($layout === null) {
        require $viewPath;
        return;
    }

    // si hay layout = usamos wrapper
    $content = $viewPath;

    $layoutPath = __DIR__ . '/../views/layout/' . $layout . '.php';

    if (!file_exists($layoutPath)) {
        die("Error: Layout no existe.");
    }

    require $layoutPath;
}





    

    protected function json($status, $message, $redirect = null)
    {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'redirect' => $redirect ?? Env::get('APP_URL') // Sin redirect, va al home
        ]);
        exit;
        // Importante para cortar la ejecución aquí
    }
}


