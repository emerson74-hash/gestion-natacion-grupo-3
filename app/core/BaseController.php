<?php
// ==================================================
// CONTROLADOR BASE DEL SISTEMA
// --------------------------------------------------
// Centraliza funcionalidades comunes para todos los
// los controladores:
//
// - Manejo de sesiones
// - Control de autenticación
// - Control de roles
// - Renderizado de vistas
// - Respuestas JSON para AJAX/Fetch
//
// Sigue el patrón MVC y el principio DRY
// (Don't Repeat Yourself).
// ==================================================

class BaseController
{

    public function __construct()
    {
    
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }



    protected function checkAuth()
    {
        if (!isset($_SESSION['user_id'])) {

          
            if (
                !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
            ) {

                // Respuesta JSON para ser procesada por JavaScript.
                $this->json(
                    'error',
                    'Sesión expirada',
                    '?url=login'
                );

            } else {

            
                header('Location: ?url=login');
                exit;
            }
        }
    }


    
    protected function checkRole($roles)
    {
 
        if (
            !isset($_SESSION['role_id']) ||
            !in_array($_SESSION['role_id'], (array) $roles)
        ) {
            header('Location: ?url=home');
            exit;
        }
    }

    /**
     * Renderiza una vista.
     *
     * @param string $view   Ruta de la vista.
     * @param array  $data   Datos enviados a la vista.
     * @param string|null $layout Layout opcional.
     *
     */
    protected function render($view, $data = [], $layout = null)
    {

        extract($data);

        $viewPath = __DIR__ . '/../views/' . $view . '.php';


        if (!file_exists($viewPath)) {
            die("Error: La vista '{$view}' no existe.");
        }

        if ($layout === null) {
            require $viewPath;
            return;
        }

        $content = $viewPath;

     
        $layoutPath = __DIR__ . '/../views/layout/' . $layout . '.php';

      
        if (!file_exists($layoutPath)) {
            die("Error: El layout '{$layout}' no existe.");
        }

        require $layoutPath;
    }

    /**
     * Genera una respuesta JSON estandarizada.
     *
     * Utilizado principalmente para solicitudes AJAX
     * o Fetch desde JavaScript.
     *
     * @param string $status   Estado de la operación.
     * @param string $message  Mensaje descriptivo.
     * @param string|null $redirect URL de redirección.
     */
    protected function json($status, $message, $redirect = null)
    {
        
        header('Content-Type: application/json');

       
        echo json_encode([
            'status' => $status,
            'message' => $message,

     
            'redirect' => $redirect ?? Env::get('APP_URL')
        ]);

   
        exit;
    }
}
