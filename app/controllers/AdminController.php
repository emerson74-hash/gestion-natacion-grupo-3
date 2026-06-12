<?php


require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php'; //importamos la carpeta que vamos a utilizar
require_once __DIR__ . '/../models/Lesson.php';

//Importamos PHPMailer para los mail
require_once __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../libs/PHPMailer/src/Exception.php';

//Servicio 
require_once __DIR__ . '/../services/MailService.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends BaseController
{
    /**
     * Muestra el panel principal.
     * Ahora usa el motor de renderizado heredado de BaseController
     * para mantener la coherencia en todo el proyecto.
     */

    private $userModel;
    private $lessonModel;


    public function __construct() //Definimos un constructor para la clase.
    {
        parent::__construct();

        global $pdo; //conexion global a la base de datos 

        if (!$pdo) {
            die("ERROR: PDO no está conectado");
        }
        $this->userModel = new User($pdo); //Creamos el modelo user 
        //para poder utilizarlo posteriormente 
        $this->lessonModel = new Lesson($pdo);
    }



    public function dashboard()
    {
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([1]);

        $data = [
            'title' => "Dashboard - Swimming School",
            'user' => $_SESSION['email'] ?? 'Guest'
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

        $email = trim($_POST['email'] ?? '');

        if (empty($email)) {

            $_SESSION['error'] = 'Debe ingresar un correo electrónico';

            header('Location: ?url=admin&section=create-coach');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $_SESSION['error'] = 'El correo electrónico no es válido';

            header('Location: ?url=admin&section=create-coach');
            exit;
        }

        $tempPassword = substr(bin2hex(random_bytes(4)), 0, 8);

        $data = [

            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'phone' => $_POST['phone'],
            'birth_date' => $_POST['birth_date'],
            'email' => $_POST['email'],
            'specialty' => $_POST['specialty'],

            'profile_image' => null,


            'password' => password_hash(
                $tempPassword,
                PASSWORD_DEFAULT
            ),

            'role_id' => 2 // coach
        ];



        if ($this->userModel->emailExists($_POST['email'])) {
            $_SESSION['error'] = "El email ya existe";

            //header("Location: ?url=admin&section=create-coach");
            exit;
        }



        //Una vez creado el coach, envia el mail automatico
        $this->userModel->createCoach($data);

        $mailService = new MailService();

        $mailService->sendCoachCredentials(
            $data['email'],
            $data['first_name'],
            $tempPassword
        );

        $_SESSION['success'] = 'Entrenador creado correctamente';

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

    //Admin: Parte Clases 

    public function lessons()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $lessons = $this->lessonModel->getAll();

        $data = [
            'lessons' => $lessons
        ];

        $this->render('admin/lessons.view', $data);
    }

    //crear clase
    public function createLesson()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $coaches = $this->userModel->getCoaches();

        $data = [
            'coaches' => $coaches
        ];

        $this->render('admin/create-lessons.view', $data);
    }

    //Datos
    public function storeLesson()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        /* $data = [
              'level' => $_POST['level'],
              'day_of_week' => $_POST['day_of_week'],
              'start_time' => $_POST['start_time'],
              'end_time' => $_POST['end_time'],
              'capacity' => $_POST['capacity'],
              'profile_id' => $_POST['profile_id']
          ];**/


        //$this->lessonModel->create($data);

        //header("Location: ?url=admin&section=lessons");
        // exit;

        if (
            $this->lessonModel->hasScheduleConflict(
                $_POST['profile_id'],
                $_POST['day_of_week'],
                $_POST['start_time'],
                $_POST['end_time']
            )
        ) {
            $_SESSION['error'] = "El horario ya está ocupado";

            header("Location: ?url=admin&section=create-lesson");
            exit;
        }

        $data = [
            'level' => $_POST['level'],
            'day_of_week' => $_POST['day_of_week'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'capacity' => $_POST['capacity'],
            'profile_id' => $_POST['profile_id']
        ];

        $this->lessonModel->create($data);

        $_SESSION['success'] = "Clase creada correctamente";

        header("Location: ?url=admin&section=lessons");
        exit;

    }

    //Boton de editar clases
    public function editLesson()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $id = $_GET['id'];

        $lesson = $this->lessonModel->getById($id);

        $coaches = $this->userModel->getCoaches();

        $data = [
            'lesson' => $lesson,
            'coaches' => $coaches
        ];

        $this->render('admin/edit-lessons.view', $data);
    }

    //Boton de eliminar clases
    public function updateLesson()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $data = [

            'id' => $_POST['id'],
            'level' => $_POST['level'],
            'day_of_week' => $_POST['day_of_week'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'capacity' => $_POST['capacity'],
            'profile_id' => $_POST['profile_id']
        ];

        $this->lessonModel->update($data);

        header("Location: ?url=admin&section=lessons");
        exit;
    }

    //Boton eliminar
    public function deleteLesson()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $id = $_GET['id'];

        $this->lessonModel->delete($id);

        header("Location: ?url=admin&section=lessons");
        exit;
    }

}