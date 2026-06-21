<?php


require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Lesson.php';
require_once __DIR__ . '/../models/Profile.php';
require_once __DIR__ . '/../models/User.php';

class CoachController extends BaseController
{
    private $profileModel;
    private $authModel;

    public function __construct()
    {
        global $pdo;

        $this->profileModel = new Profile($pdo);
        $this->authModel = new User($pdo);
    }
    /**
     * Muestra el panel principal.
     * Ahora usa el motor de renderizado heredado de BaseController
     * para mantener la coherencia en todo el proyecto.
     */
    public function dashboard()
    {
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([2]);
        $data = [
            'title' => "Dashboard - Swimming School",
            'user' => $_SESSION['email'] ?? 'Guest'
        ];



        // El método render busca automáticamente en /views/ y permite pasar datos
        $this->render('coach/dashboard.view', $data);
    }

    public function profile()
    {
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([2]);
        $data = [
            'title' => "Dashboard - Swimming School",
            'user' => $_SESSION['email'] ?? 'Guest'
        ];



        // El método render busca automáticamente en /views/ y permite pasar datos
        $this->render('coach/profile.view', $data);
    }

    public function lessons()
    {
        $this->checkAuth();
        $this->checkRole([2]);

        global $pdo;

        $lessonModel = new Lesson($pdo);

        $lessons = $lessonModel->getAll();

        $students = [];
        $selectedLessonId = $_GET['id'] ?? null;

        if ($selectedLessonId) {
            $students = $lessonModel->getStudentsByLesson($selectedLessonId);
        }

        $this->render('coach/lessons.view', [
            'lessons' => $lessons,
            'students' => $students,
            'selectedLessonId' => $selectedLessonId
        ]);
    }

    public function edit()
    {

        $this->checkAuth();
        $this->checkRole([2]);
        $data = [
            'title' => "Dashboard - Swimming School",
            'user' => $_SESSION['email'] ?? 'Guest'
        ];




        $this->render('coach/edit.view', $data);
    }

public function updateProfile()
{
    $this->checkAuth();
    $this->checkRole([2]);

    $userId = $_SESSION['user_id'];

    $firstName = $_POST['nuevo_nombre'] ?? '';
    $lastName = $_POST['nuevo_apellido'] ?? '';
    $specialty = $_POST['nueva_especialidad'] ?? '';
    $phone = $_POST['telefono'] ?? '';
    $birthDate = $_POST['birth_date'] ?? null;

    $newPassword = $_POST['nueva_contraseña'] ?? '';
    $confirmPass = $_POST['confirmar_nueva_contraseña'] ?? '';

    $profileImage = $_SESSION['profile_image'] ?? '';
    $oldProfileImage = $profileImage;

    if (
        isset($_FILES['profile_image']) &&
        $_FILES['profile_image']['error'] === UPLOAD_ERR_OK
    ) {
        $uploadDir = __DIR__ . '/../../public/img/uploads/profiles/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = strtolower(
            pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION)
        );

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($extension, $allowedExtensions)) {
            return $this->json(
                'warning',
                'El formato de archivo no es válido. Solo imágenes.'
            );
        }

        $newFileName = 'profile_' . $userId . '_' . time() . '.' . $extension;
        $absolutePath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $absolutePath)) {

            $profileImage = $newFileName;

            if (
                !empty($oldProfileImage) &&
                $oldProfileImage !== 'default-profile.png'
            ) {
                $oldPath = $uploadDir . $oldProfileImage;

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

        } else {
            return $this->json(
                'error',
                'No se pudo mover el archivo al directorio de destino.'
            );
        }
    }

            $this->profileModel->updateCoachProfile([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $phone,
                'birth_date' => $birthDate,
                'specialty' => $specialty,
                'profile_image' => $profileImage,
                'user_id' => $userId
            ]);
    if (!empty(trim($newPassword))) {

        if (strlen($newPassword) < 6) {
            return $this->json(
                'warning',
                'La contraseña debe tener al menos 6 caracteres.'
            );
        }

        if ($newPassword !== $confirmPass) {
            return $this->json(
                'warning',
                'Las contraseñas no coinciden.'
            );
        }

        $this->authModel->updateCoachPassword(
            $userId,
            $newPassword
        );
    }

    $_SESSION['first_name'] = $firstName;
    $_SESSION['last_name'] = $lastName;
    $_SESSION['specialty'] = $specialty;
    $_SESSION['profile_image'] = $profileImage;
    $_SESSION['phone'] = $phone;
    $_SESSION['birth_date'] = $birthDate;

    $baseUrl = rtrim(Env::get('APP_URL'), '/');
    $redirect = $baseUrl . '/?url=coach/dashboard';

    return $this->json(
        'success',
        'Perfil actualizado correctamente',
        $redirect
    );
}

    public function getStudents()
    {
        $this->checkAuth();
        $this->checkRole([2]);

        global $pdo;

        $lessonModel = new Lesson($pdo);

        $lessonId = $_GET['lesson_id'] ?? null;

        if (!$lessonId) {
            echo json_encode([]);
            exit;
        }

        $students = $lessonModel->getStudentsByLesson($lessonId);

        header('Content-Type: application/json');

        echo json_encode($students);
        exit;
    }


}