<?php


require_once __DIR__ . '/../core/BaseController.php';

class CoachController extends BaseController {
    /**
     * Muestra el panel principal.
     * Ahora usa el motor de renderizado heredado de BaseController
     * para mantener la coherencia en todo el proyecto.
     */
    public function dashboard() {
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([2]);
        $data = [
            'title' => "Dashboard - Swimming School",
            'user'  => $_SESSION['email'] ?? 'Guest'
        ];

        
        
        // El método render busca automáticamente en /views/ y permite pasar datos
        $this->render('coach/dashboard.view', $data);
    }

    public function profile() {
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([2]);
        $data = [
            'title' => "Dashboard - Swimming School",
            'user'  => $_SESSION['email'] ?? 'Guest'
        ];

        
        
        // El método render busca automáticamente en /views/ y permite pasar datos
        $this->render('coach/profile.view', $data);
    }
}