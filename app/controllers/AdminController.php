<?php

require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Profile.php';

require_once __DIR__ . '/../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../libs/PHPMailer/src/Exception.php';

require_once __DIR__ . '/../services/MailService.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends BaseController
{
    private $userModel;
    private $lessonModel;
    private $profileModel;

    public function __construct()
    {
        parent::__construct();

        global $pdo;

        if (!$pdo) {
            die("ERROR: PDO no está conectado");
        }

        $this->userModel = new User($pdo);
        $this->lessonModel = new Lesson($pdo);
        $this->profileModel = new Profile($pdo);
    }

    public function dashboard()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $data = [
            'title' => "Dashboard - Swimming School",
            'user' => $_SESSION['email'] ?? 'Guest'
        ];

        $this->render('admin/dashboard.view', $data);
    }

    public function coaches()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $coaches = $this->userModel->getCoaches();

        $data = [
            'coaches' => $coaches
        ];

        $this->render('admin/coaches.view', $data);
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

        if ($this->userModel->emailExists($email)) {
            $_SESSION['error'] = "El email ya existe";
            header("Location: ?url=admin&section=create-coach");
            exit;
        }

        $tempPassword = substr(bin2hex(random_bytes(4)), 0, 8);

        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'phone' => $_POST['phone'],
            'birth_date' => $_POST['birth_date'],
            'email' => $email,
            'specialty' => $_POST['specialty'],
            'profile_image' => null,
            'password' => password_hash($tempPassword, PASSWORD_DEFAULT),
            'role_id' => 2
        ];

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

    $id = $_POST['id'] ?? null;

    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $phone_raw  = $_POST['phone'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $specialty  = $_POST['specialty'] ?? '';

    // ======================
    // VALIDACIÓN ID
    // ======================
    if (!$id) {
        $_SESSION['error'] = "ID inválido";
        header("Location: ?url=admin&section=coaches");
        exit;
    }

    // ======================
    // VALIDACIONES BÁSICAS
    // ======================
    if ($first_name === '') {
        $_SESSION['error'] = "Debe ingresar su nombre";
        header("Location: ?url=admin&section=edit-coach&id=$id");
        exit;
    }

    if ($last_name === '') {
        $_SESSION['error'] = "Debe ingresar su apellido";
        header("Location: ?url=admin&section=edit-coach&id=$id");
        exit;
    }

    if ($email === '') {
        $_SESSION['error'] = "Debe ingresar su email";
        header("Location: ?url=admin&section=edit-coach&id=$id");
        exit;
    }

    if ($specialty === '') {
        $_SESSION['error'] = "Debe seleccionar una especialidad";
        header("Location: ?url=admin&section=edit-coach&id=$id");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Email inválido";
        header("Location: ?url=admin&section=edit-coach&id=$id");
        exit;
    }
// ======================
// VALIDACIÓN FECHA DE NACIMIENTO
// ======================
if (empty($birth_date)) {
    $_SESSION['error'] = "Debe ingresar la fecha de nacimiento";
    header("Location: ?url=admin&section=edit-coach&id=$id");
    exit;
}

$birthDateObj = DateTime::createFromFormat('Y-m-d', $birth_date);

if (!$birthDateObj || $birthDateObj->format('Y-m-d') !== $birth_date) {
    $_SESSION['error'] = "La fecha de nacimiento no es válida";
    header("Location: ?url=admin&section=edit-coach&id=$id");
    exit;
}

$age = (new DateTime())->diff($birthDateObj)->y;

if ($age < 18) {
    $_SESSION['error'] = "El entrenador debe tener al menos 18 años";
    header("Location: ?url=admin&section=edit-coach&id=$id");
    exit;
}

if ($age > 80) {
    $_SESSION['error'] = "La fecha de nacimiento ingresada no parece válida";
    header("Location: ?url=admin&section=edit-coach&id=$id");
    exit;
}
// ======================
// VALIDACIÓN TELÉFONO (REQUERIDO)
// ======================
$phone = preg_replace('/\D/', '', $phone_raw);

if (empty(trim($phone_raw))) {
    $_SESSION['error'] = "Debe ingresar un número de teléfono";
    header("Location: ?url=admin&section=edit-coach&id=$id");
    exit;
}

if (strlen($phone) < 8 || strlen($phone) > 15) {
    $_SESSION['error'] = "El teléfono debe tener entre 8 y 15 dígitos";
    header("Location: ?url=admin&section=edit-coach&id=$id");
    exit;
}
   

    // ======================
    // EMAIL DUPLICADO
    // ======================
    $existing = $this->userModel->findByEmail($email);

    if ($existing && $existing['id'] != $id) {
        $_SESSION['error'] = "Ese email ya está en uso";
        header("Location: ?url=admin&section=edit-coach&id=$id");
        exit;
    }

    // ======================
    // UPDATE
    // ======================
    $data = [
        'id' => $id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'birth_date' => $birth_date,
        'specialty' => $specialty
    ];

    $this->userModel->updateCoach($data);

    $_SESSION['success'] = "Coach actualizado correctamente";

    header("Location: ?url=admin&section=coaches");
    exit;
}

    public function deleteCoach()
    {
        $this->checkAuth();
        $this->checkRole([1]);

        $id = $_GET['id'];

        if ($this->profileModel->coachHasLessons($id)) {
            $_SESSION['error'] = 'No se puede eliminar el entrenador porque tiene clases asignadas.';
        } elseif ($this->profileModel->coachHasBookings($id)) {
            $_SESSION['error'] = 'No se puede eliminar el entrenador porque tiene reservas asociadas.';
        } else {
            $this->userModel->deleteCoach($id);
            $_SESSION['success'] = 'Entrenador eliminado correctamente.';
        }

        header("Location: ?url=admin&section=coaches");
        exit;
    }
    public function lessons()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $lessons = $this->lessonModel->getAll(); // ← getAll(), no getLessons()

    $data = [
        'lessons' => $lessons
    ];

    $this->render('admin/lessons.view', $data);
}
// CREAR CLASE - vista del formulario
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

// GUARDAR CLASE NUEVA
public function storeLesson()
{
    $this->checkAuth();
    $this->checkRole([1]);

    if ($this->lessonModel->hasScheduleConflict(
        $_POST['profile_id'],
        $_POST['day_of_week'],
        $_POST['start_time'],
        $_POST['end_time']
    )) {
        $_SESSION['error'] = "El horario ya está ocupado";
        header("Location: ?url=admin&section=create-lesson");
        exit;
    }

    $data = [
        'level'      => $_POST['level'],
        'day_of_week'=> $_POST['day_of_week'],
        'start_time' => $_POST['start_time'],
        'end_time'   => $_POST['end_time'],
        'capacity'   => $_POST['capacity'],
        'profile_id' => $_POST['profile_id']
    ];

    $this->lessonModel->create($data);

    $_SESSION['success'] = "Clase creada correctamente";
    header("Location: ?url=admin&section=lessons");
    exit;
}

// EDITAR CLASE - vista del formulario
public function editLesson()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $id      = $_GET['id'];
    $lesson  = $this->lessonModel->getById($id);
    $coaches = $this->userModel->getCoaches();

    $data = [
        'lesson'  => $lesson,
        'coaches' => $coaches
    ];

    $this->render('admin/edit-lessons.view', $data);
}

// GUARDAR CAMBIOS DE CLASE
public function updateLesson()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $data = [
        'id'         => $_POST['id'],
        'level'      => $_POST['level'],
        'day_of_week'=> $_POST['day_of_week'],
        'start_time' => $_POST['start_time'],
        'end_time'   => $_POST['end_time'],
        'capacity'   => $_POST['capacity'],
        'profile_id' => $_POST['profile_id']
    ];

    $this->lessonModel->update($data);

    $_SESSION['success'] = "Clase actualizada correctamente";
    header("Location: ?url=admin&section=lessons");
    exit;
}

// ELIMINAR CLASE
public function deleteLesson()
{
    $this->checkAuth();
    $this->checkRole([1]);

    $id      = $_GET['id'];
    $deleted = $this->lessonModel->delete($id);

    if (!$deleted) {
        $_SESSION['error'] = 'No se puede eliminar la clase porque tiene alumnos inscriptos.';
        header("Location: ?url=admin&section=lessons");
        exit;
    }

    $_SESSION['success'] = 'Clase eliminada correctamente.';
    header("Location: ?url=admin&section=lessons");
    exit;
}

}