<?php
 
require_once __DIR__ . '/../core/BaseController.php';
 
class LandingController extends BaseController {
 
    /**
     * Muestra la landing page pública.
     */
    public function index() {
        require_once __DIR__ . '/../views/landing.view.php';
    }
}
 