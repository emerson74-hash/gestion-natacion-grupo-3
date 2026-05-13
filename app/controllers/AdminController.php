<?php


require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php'; //importamos la carpeta que vamos a utilizar

class AdminController extends BaseController {
    /**
     * Muestra el panel principal.
     * Ahora usa el motor de renderizado heredado de BaseController
     * para mantener la coherencia en todo el proyecto.
     */


    
    public function __construct() //Definimos un constructor para la clase.
   {
    global $pdo; //Conexion global a la base de datos

    $this->userModel = new User($pdo); //Creamos el modelo user 
    //para poder utilizarlo posteriormente 
   } 



    public function dashboard() {
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([1]);

        $data = [
            'title' => "Dashboard - Swimming School",
            'user'  => $_SESSION['email'] ?? 'Guest'
        ];
        
        // El método render busca automáticamente en /views/ y permite pasar datos
        $this->render('admin/dashboard.view', $data);


    }


      public function coaches()
    {
        $this->checkAuth();//Verifica que se inicia sesion.

        $this->checkRole([1]);//Comprueba que sea admin, pos 1.

        $coaches = $this->userModel->getCoaches(); //"Pedimos" coaches al modelo.

        $data = [
            'title' => 'Coach Management',
            'coaches' => $coaches //Envia coaches a la vista.
        ];

        $this->render('admin/coaches.view', $data); //Carga las carpetas.
    }









}