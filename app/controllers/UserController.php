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
class UserController extends BaseController
{
    private $userModel;
    private $profileModel;
    private $pdo;

    public function __construct()
    {
        // Traemos la conexión global a la base de datos
        global $pdo;

        $this->pdo = $pdo;

        // Inicializamos los modelos
        $this->userModel    = new User($pdo);
        $this->profileModel = new Profile($pdo);
    }

    // --- SECCIÓN: VISTAS Y LISTADOS ---

    /**
     * Muestra todos los swimmers registrados.
     */
    public function index()
    {
        // Verificamos que el usuario tenga sesión iniciada
        $this->checkAuth();

        // Traemos solo perfiles de swimmers
        $profiles = $this->profileModel->getAllSwimmers();

        // Mostramos la vista
        $this->render('users/index', ['profiles' => $profiles]);
    }

    /**
     * Muestra la vista de login.
     */
    public function showLogin()
    {
        $this->render('users/login.view');
    }

    /**
     * Muestra el formulario de registro.
     */
    public function showRegister()
    {
        $this->render('users/register.view', [
            'title' => 'Inscripción de Alumnos'
        ]);
    }

    /**
     * Muestra la vista para recuperar contraseña.
     */
    public function forgotPassword()
    {
        $this->render('users/forgot-password.view', [
            'title' => 'Recuperar Contraseña'
        ]);
    }

    // --- SECCIÓN: REGISTRO DE USUARIOS ---

    /**
     * Procesa el registro de nuevos swimmers.
     */
    public function register()
    {
        // Solo permitimos peticiones POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->showRegister();
        }

        // Guardamos y limpiamos los datos enviados desde el formulario
        $fields = [
            'first_name'      => trim($_POST['nombre'] ?? ''),
            'last_name'       => trim($_POST['apellido'] ?? ''),
            'email'           => trim($_POST['email'] ?? ''),
            'password'        => $_POST['password'] ?? '',
            'passwordconfirm' => $_POST['passwordconfirm'] ?? '',
            'phone'           => trim($_POST['telefono'] ?? ''),
            'birth_date'      => trim($_POST['birth_date'] ?? ''),

            // Imagen por defecto
            'profile_image'   => 'default-profile.png'
        ];

        // Validamos campos obligatorios
        if ($this->hasEmptyFields($fields)) {
            return $this->json('warning', 'Faltan datos obligatorios.');
        }

        // Validamos formato del email
        if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->json('error', 'El email ingresado no es válido.');
        }

        // Validamos longitud mínima de contraseña
        if (strlen($fields['password']) < 6) {
            return $this->json('warning', 'La contraseña es muy corta.');
        }

        if (strlen($fields['passwordconfirm']) < 6) {
            return $this->json('warning', 'La contraseña es muy corta.');
        }

        // Verificamos que ambas contraseñas coincidan
        if ($fields['password'] !== $fields['passwordconfirm']) {
            return $this->json('warning', 'Las contraseñas no coinciden.');
        }

        // --- SUBIDA DE IMAGEN DE PERFIL ---

        $tempFile = null;

        // Verificamos si se subió una imagen
        if (isset($_FILES['profile_image']) &&
            $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = __DIR__ . '/../../public/img/uploads/profiles/';

            // Creamos la carpeta si no existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Obtenemos extensión del archivo
            $extension = strtolower(
                pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION)
            );

            // Extensiones permitidas
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($extension, $allowed)) {

                // Generamos nombre único para la imagen
                $initial = strtolower(substr($fields['first_name'], 0, 1));

                $lastName = strtolower(
                    str_replace(' ', '', $fields['last_name'])
                );

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

                // Movemos la imagen a la carpeta final
                if (move_uploaded_file(
                    $_FILES['profile_image']['tmp_name'],
                    $absolutePath
                )) {

                    $fields['profile_image'] = $newFileName;
                    $tempFile = $absolutePath;
                }
            }
        }

        // Ejecutamos el registro
        return $this->executeRegistration($fields, $tempFile);
    }

    /**
     * Lógica de inscripción con Transacción SQL.
     * Si algo falla en el medio, se hace rollback para no dejar datos a medias.
     */
    private function executeRegistration($f, $tempFile = null)
    {
        try {
            // Verificamos si el email ya está registrado
            if ($this->userModel->findByEmail($f['email'])) {

                // Si ya existe, borramos la foto que subimos para no dejar basura
                if ($tempFile && file_exists($tempFile)) {
                    unlink($tempFile);
                }

                return $this->json('warning', 'Ya tienes una cuenta registrada.');
            }

            $this->pdo->beginTransaction();

            // Paso 1: creamos el usuario en la tabla users ( solo credenciales )
            $userId = $this->userModel->create([
                'email'    => $f['email'],
                'password' => $f['password'],
                'role_id'  => 3 // Rol Swimmer
            ]);

            if (!$userId)
                throw new Exception('Error al crear credenciales.');

            // Paso 2: creamos el perfil en la tabla profiles ( datos personales )
            // specialty = null indica que es un Swimmer ( los Coaches tienen specialty con valor )
            $f['user_id']   = $userId;
            $f['specialty'] = null;
            $this->profileModel->create($f);

            $this->pdo->commit();

            // Obtenemos la URL base del .env para redirigir al login
            $baseUrl = rtrim(Env::get('APP_URL'), '/');

            // Si por algún error el .env está vacío, usamos una base segura
            if (empty($baseUrl)) {
                $baseUrl = 'http://localhost/gestion-natacion';
            }

            $loginUrl = $baseUrl . '/?url=login';

            return $this->json('success', '¡Registro completado!', $loginUrl);

        } catch (Exception $e) {
            if ($this->pdo->inTransaction())
                $this->pdo->rollBack();

            // Si algo falló en SQL, borramos la foto para no dejar basura
            if ($tempFile && file_exists($tempFile)) {
                unlink($tempFile);
            }

            return $this->json('error', 'No se pudo completar: ' . $e->getMessage());
        }
    }

    // --- SECCIÓN: AUTENTICACIÓN ---

    /**
     * Procesa el inicio de sesión.
     */
    public function authenticate()
    {
        // Solo permitimos peticiones POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Acceso no permitido.');
        }

        $email = trim($_POST['email'] ?? '');
        $pass  = $_POST['password']   ?? '';

        // Verificamos las credenciales contra la base de datos
        $user = $this->userModel->login($email, $pass);

        if ($user) {

            // Guardamos los datos del usuario en la sesión
            $_SESSION['user_id']       = $user['id'];
            $_SESSION['role_id']       = $user['role_id'];
            $_SESSION['email']         = $user['email'];
            // Datos para el saludo y la foto que pide el layout
            $_SESSION['first_name']    = $user['first_name'];
            $_SESSION['profile_image'] = $user['profile_image'];

            // Redirigimos al dashboard que corresponde según el rol del usuario
            switch ($user['role_id']) {

                case 1:
                    $redirect = Env::get('APP_URL') . '/?url=admin/dashboard';
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

            return $this->json(
                'success',
                '¡Bienvenido ' . $user['first_name'] . '!',
                $redirect
            );
        }

        return $this->json('error', 'Credenciales incorrectas.');
    }

    // --- SECCIÓN: RECUPERACIÓN DE CONTRASEÑA ---

    /**
     * Envía el email con el enlace de recuperación de contraseña.
     */
    public function sendReset()
    {
        $email = $_POST['email'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->json('error', 'Email inválido.');
        }

        $user = $this->userModel->findByEmail($email);

        if ($user) {
            // Generamos un token único y seguro con expiración de 1 hora
            $token   = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $this->userModel->savePasswordToken($email, $token, $expires);

            require_once __DIR__ . '/../services/MailService.php';
            $mailService = new MailService();

            $enviado = $mailService->sendEmailResetPassword($email, $token);

            if (!$enviado) {
                return $this->json('error', 'El servidor de correo falló.');
            }
        }

        // Siempre respondemos igual para no revelar si el email existe o no ( seguridad )
        return $this->json(
            'success',
            'Si el correo existe, recibirás un enlace de recuperación.',
            Env::get('APP_URL') . '/?url=login'
        );
    }

    /**
     * Muestra el formulario para ingresar la nueva contraseña.
     */
    public function showResetForm()
    {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            die('Error: El token de recuperación ha expirado o es inválido.');
        }

        $this->render('users/reset-password.view', [
            'title' => 'Restablecer Contraseña',
            'token' => $token
        ]);
    }

    /**
     * Procesa el cambio de contraseña con el token de recuperación.
     */
    public function updatePassword()
    {
        $token    = $_POST['token']    ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($token) || strlen($password) < 6) {
            return $this->json('warning', 'La contraseña debe tener al menos 6 caracteres.');
        }

        // Verificamos que el token exista y no haya expirado
        $resetRequest = $this->userModel->validateToken($token);

        if ($resetRequest) {
            $email          = $resetRequest['email'];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            try {
                $this->pdo->beginTransaction();

                // Actualizamos la contraseña y eliminamos el token usado
                $this->userModel->updatePasswordByEmail($email, $hashedPassword);
                $this->userModel->deleteToken($token);

                $this->pdo->commit();

                return $this->json(
                    'success',
                    '¡Contraseña actualizada con éxito!',
                    Env::get('APP_URL') . '?url=login'
                );

            } catch (Exception $e) {
                if ($this->pdo->inTransaction())
                    $this->pdo->rollBack();
                return $this->json('error', 'No se pudo actualizar la contraseña.');
            }
        }

        return $this->json('error', 'El enlace es inválido o ha expirado.');
    }

    /**
     * Verifica que los campos obligatorios no estén vacíos.
     */
    private function hasEmptyFields($f)
    {
        return empty($f['first_name']) ||
               empty($f['last_name'])  ||
               empty($f['email'])      ||
               empty($f['password']);
    }
}