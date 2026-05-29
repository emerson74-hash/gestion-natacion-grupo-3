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
    parent::__construct();

    global $pdo; //conexion global a la base de datos 

    if (!$pdo) {
        die("ERROR: PDO no está conectado");
    }
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
          //  'title' => 'Coach Management',
            'coaches' => $coaches //Envia coaches a la vista.
        ];

        $this->render('admin/coaches.view', $data); //Carga las carpetas.

    }

    public function createCoach()
   {
    $this->checkAuth();
    $this->checkRole([1]);

    $this->render('admin/create-coach.view');
   }


   public function storeCoach()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $data = [

        'first_name' => $_POST['first_name'],
        'last_name'  => $_POST['last_name'],
        'phone' => $_POST['phone'],
        'birth_date' => $_POST['birth_date'],
        'email'      => $_POST['email'],
        'specialty'  => $_POST['specialty'],

        'password' => password_hash(
            $_POST['password'],
            PASSWORD_DEFAULT
        ),

        'role_id' => 2 // coach
    ];



    if($this->userModel->emailExists($_POST['email']))
{
    die("El email ya existe");
}

    $this->userModel->createCoach($data);

    header("Location: ?url=admin&section=coaches");
    exit;
}


//Metodo de editar boton 
    public function editCoach()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $id = $_GET['id'];

    $coach = $this->userModel->getCoachById($id);

    $data = [
        'coach' => $coach
    ];

    $this->render('admin/edit-coach.view', $data);
}    

public function updateCoach()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $data = [

        'id' => $_POST['id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'specialty' => $_POST['specialty']

    ];

    $this->userModel->updateCoach($data);

    header("Location: ?url=admin&section=coaches");
    exit;
}

//Metodo para permitir al admin usar el boton eliminar en la tabla
public function deleteCoach()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $id = $_GET['id'];

    $this->userModel->deleteCoach($id);

    header("Location: ?url=admin&section=coaches");
    exit;
}


    //ADMIN: Conexion al menu en view/layout
   /* public function panel(){
    //Busca por defecto la URL dashboard
    $section = $_GET['section'] ?? 'dashboard';

    switch($section){

    case 'coaches':
        $view = "View/admin/coaches.view.php";  //Si la URL coincide, va a buscar la vista para mostrar a coaches
        break;

    case 'swimmers':
        $view = "View/admin/swimmers.view.php";
        break;

    default:
        $view = "View/admin/dashboard.view.php";
        break;
    }

include "View/layout/admin.layout.php"; //carga del layout principal de admin

    }**/





}