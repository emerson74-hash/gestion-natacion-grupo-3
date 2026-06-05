<?php


require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Lesson.php';

class CoachController extends BaseController
{
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
        // Verificamos si el usuario está logueado antes de mostrar el panel
        $this->checkAuth();
        $this->checkRole([2]);
        $data = [
            'title' => "Dashboard - Swimming School",
            'user' => $_SESSION['email'] ?? 'Guest'
        ];



        // El método render busca automáticamente en /views/ y permite pasar datos
        $this->render('coach/edit.view', $data);
    }
    public function updateProfile()
    {
        
        $this->checkAuth();
        $this->checkRole([2]);

        $nombre = trim($_POST['nuevo_nombre'] ?? '');
        $apellido = trim($_POST['nuevo_apellido'] ?? '');
        $especialidad = trim($_POST['nueva_especialidad'] ?? '');

        if (!$nombre || !$apellido) {
            die("Nombre y apellido son obligatorios");
        }

        // ==========================
        // SUBIDA DE FOTO
        // ==========================

        $profileImage = $_SESSION['profile_image'];

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

            $newFileName =
                'profile_' .
                $_SESSION['user_id'] .
                '_' .
                time() .
                '.' .
                $extension;

            $absolutePath = $uploadDir . $newFileName;

            if (
                move_uploaded_file(
                    $_FILES['profile_image']['tmp_name'],
                    $absolutePath
                )
            ) {
                $profileImage = $newFileName;
            }
        }

        global $pdo;

        $sql = "UPDATE profiles
            SET first_name = ?,
                last_name = ?,
                specialty = ?,
                profile_image = ?
            WHERE user_id = ?";
            
            

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $nombre,
            $apellido,
            $especialidad,
            $profileImage,
            $_SESSION['user_id']
        ]);
        

        $_SESSION['first_name'] = $nombre;
        $_SESSION['last_name'] = $apellido;
        $_SESSION['specialty'] = $especialidad;
        $_SESSION['profile_image'] = $profileImage;

        header('Location: ?url=coach/profile');
        exit;
    }

}