<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Profile.php';

/**
 * Controlador encargado del manejo de usuarios. se gestionan:
 * - login
 * - registro
 * - recuperación de contraseña
 * - listado de swimmers
 */
class AuthController extends BaseController
{
    private $userModel;
    private $profileModel;
    private $pdo;

    public function __construct()
    {
        parent::__construct();

        // Traemos la conexión global a la base de datos
        global $pdo;

        $this->pdo = $pdo;

        // Inicializamos los modelos
        $this->userModel = new User($pdo);
        $this->profileModel = new Profile($pdo);
    }

    // --- SECCIÓN: VISTAS Y LISTADOS ---

    public function index()
    {
        $this->checkAuth();
        $profiles = $this->profileModel->getAllSwimmers();
        $this->render('users/index', ['profiles' => $profiles]);
    }

    public function showLogin()
    {
        $this->render('users/login.view');
    }

    public function showRegister()
    {
        $this->render('users/register.view', [
            'title' => 'Inscripción de Alumnos'
        ]);
    }

    public function forgotPassword()
    {
        $this->render('users/forgot-password.view', [
            'title' => 'Recuperar Contraseña'
        ]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->showRegister();
        }

        $fields = [
            'first_name' => trim($_POST['nombre'] ?? ''),
            'last_name' => trim($_POST['apellido'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'passwordconfirm' => $_POST['passwordconfirm'] ?? '',
            'phone' => trim($_POST['telefono'] ?? ''),
            'birth_date' => trim($_POST['birth_date'] ?? ''),
            'profile_image' => 'default-profile.png'
        ];

        if ($this->hasEmptyFields($fields)) {
            return $this->json('warning', 'Faltan datos obligatorios.');
        }

        if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->json('error', 'El email ingresado no es válido.');
        }

        if (strlen($fields['password']) < 6 || strlen($fields['passwordconfirm']) < 6) {
            return $this->json('warning', 'La contraseña es muy corta.');
        }

        if ($fields['password'] !== $fields['passwordconfirm']) {
            return $this->json('warning', 'Las contraseñas no coinciden.');
        }

        $tempFile = null;

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = __DIR__ . '/../../public/img/uploads/profiles/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($extension, $allowed)) {

                $initial = strtolower(substr($fields['first_name'], 0, 1));
                $lastName = strtolower(str_replace(' ', '', $fields['last_name']));
                $randomNumber = rand(1000, 9999);

                $newFileName =
                    'swimmer_' .
                    $initial .
                    $lastName .
                    '_' .
                    $randomNumber .
                    '.' .
                    $extension;

                $absolutePath = $uploadDir . $newFileName;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $absolutePath)) {
                    $fields['profile_image'] = $newFileName;
                    $tempFile = $absolutePath;
                }
            }
        }

        return $this->executeRegistration($fields, $tempFile);
    }

    private function executeRegistration($f, $tempFile = null)
    {
        try {
            if ($this->userModel->findByEmail($f['email'])) {

                if ($tempFile && file_exists($tempFile)) {
                    unlink($tempFile);
                }

                return $this->json('warning', 'Ya tienes una cuenta registrada.');
            }

            $this->pdo->beginTransaction();

            $userId = $this->userModel->create([
                'email' => $f['email'],
                'password' => $f['password'],
                'role_id' => 3
            ]);

            if (!$userId) throw new Exception('Error al crear credenciales.');

            $f['user_id'] = $userId;
            $f['specialty'] = null;
            $this->profileModel->create($f);

            $this->pdo->commit();

            $baseUrl = rtrim(Env::get('APP_URL'), '/');

            if (empty($baseUrl)) {
                $baseUrl = 'http://localhost/gestion-natacion';
            }

            return $this->json('success', '¡Registro completado!', $baseUrl . '/?url=login');

        } catch (Exception $e) {

            if ($this->pdo->inTransaction()) $this->pdo->rollBack();

            if ($tempFile && file_exists($tempFile)) {
                unlink($tempFile);
            }

            return $this->json('error', 'No se pudo completar: ' . $e->getMessage());
        }
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Acceso no permitido.');
        }

        $email = trim($_POST['email'] ?? '');
        $pass = $_POST['password'] ?? '';

        $user = $this->userModel->login($email, $pass);

        if ($user) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['specialty'] = $user['specialty'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['profile_image'] = $user['profile_image'];

            switch ($user['role_id']) {
                case 1:
                    $redirect = Env::get('APP_URL') . '/public/?url=admin&section=dashboard';
                    break;
                case 2:
                    $redirect = Env::get('APP_URL') . '/?url=coach/dashboard';
                    break;
                case 3:
                    $redirect = Env::get('APP_URL') . '/?url=swimmer/dashboard';
                    break;
                default:
                    $redirect = Env::get('APP_URL') . '/?url=login';
                    break;
            }

            return $this->json('success', '¡Bienvenido ' . $user['first_name'] . '!', $redirect);
        }

        return $this->json('error', 'Credenciales incorrectas.');
    }

    public function sendReset() { /* sin cambios */ }
    public function showResetForm() { /* sin cambios */ }
    public function updatePassword() { /* sin cambios */ }

    private function hasEmptyFields($f)
    {
        return empty($f['first_name']) ||
            empty($f['last_name']) ||
            empty($f['email']) ||
            empty($f['password']);
    }
}