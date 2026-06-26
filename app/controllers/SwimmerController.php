<?php

require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/Profile.php';
require_once __DIR__ . '/../models/Lesson.php';

/**
 * Controlador encargado de las acciones del swimmer.
 * 
 * Desde acá se manejan:
 * - el dashboard
 * - el perfil
 * - las clases disponibles
 * - las inscripciones y cancelaciones
 */
class SwimmerController extends BaseController
{
    private $dayLabels = [
        'Monday' => 'Lunes',
        'Tuesday' => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday' => 'Jueves',
        'Friday' => 'Viernes',
        'Saturday' => 'Sábado',
        'Sunday' => 'Domingo'
    ];

    private $levelLabels = [
        'beginner' => 'Principiante',
        'intermediate' => 'Intermedio',
        'advanced' => 'Avanzado'
    ];

    private $profileModel;
    private $lessonModel;

    /**
     * Constructor del controlador.
     * 
     * Inicializa los modelos necesarios para trabajar
     * con perfiles y clases.
     */
    public function __construct()
    {
        parent::__construct();

        global $pdo;

        $this->profileModel = new Profile($pdo);
        $this->lessonModel  = new Lesson($pdo);
    }

    //  DASHBOARD 

    public function dashboard()
    {
        $this->checkAuth();
        $this->checkRole([3]);

        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);
        $profileId = $profile['id'] ?? null;

        $myBookings = $profileId
            ? $this->lessonModel->getBookingsBySwimmer($profileId)
            : [];

        $this->render('swimmer/dashboard.view', [
            'title'      => 'Mi Panel - Swimming School',
            'user'       => $_SESSION['email'] ?? 'Guest',
            'profile'    => $profile,
            'myBookings' => $myBookings,
        ]);
    }

    // PERFIL 

    public function profile()
    {
        $this->checkAuth();
        $this->checkRole([3]);

        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);

        $this->render('swimmer/profile.view', [
            'title'   => 'Mi Perfil',
            'profile' => $profile,
        ]);
    }

    public function updateProfile()
    {
        $this->checkAuth();
        $this->checkRole([3]);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Método no permitido.');
        }

        $password = trim($_POST['password'] ?? '');
        $confirm  = trim($_POST['confirm_password'] ?? '');

        if (!empty($password)) {
            if (strlen($password) < 6) {
                return $this->json('warning', 'La contraseña debe tener al menos 6 caracteres.');
            }
            if ($password !== $confirm) {
                return $this->json('warning', 'Las contraseñas no coinciden.');
            }
        }

        $data = [
            'user_id'    => $_SESSION['user_id'],
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name'  => trim($_POST['last_name']  ?? ''),
            'phone'      => trim($_POST['phone']       ?? ''),
            'birth_date' => trim($_POST['birth_date']  ?? '') ?: null,
            'password'   => $password,
        ];

        if (empty($data['first_name'])) {
            return $this->json('warning', 'El nombre es obligatorio.');
        }

        if (empty($data['last_name'])) {
            return $this->json('warning', 'El apellido es obligatorio.');
        }

        if (empty($data['phone'])) {
            return $this->json('warning', 'El teléfono es obligatorio.');
        }

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = __DIR__ . '/../../public/img/uploads/profiles/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext     = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($ext, $allowed)) {

                $oldPhoto = $_SESSION['profile_image'] ?? '';
                if ($oldPhoto && $oldPhoto !== 'default-profile.png') {
                    $oldPath = $uploadDir . $oldPhoto;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $fileName = 'profile_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;

                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $fileName)) {
                    $data['profile_image']     = $fileName;
                    $_SESSION['profile_image'] = $fileName;
                }
            }
        }

        $updated = $this->profileModel->updateProfile($data);

        if ($updated) {
            $profile = $this->profileModel->findByUserId($_SESSION['user_id']);
            if ($profile) {
                $_SESSION['first_name'] = $profile['first_name'];
                $_SESSION['last_name']  = $profile['last_name'];
            }
        }

        return $updated
            ? $this->json('success', 'Perfil actualizado correctamente.', '?url=swimmer/dashboard')
            : $this->json('error', 'No se pudo actualizar el perfil.');
    }

    // LECCIONES

    public function lessons()
    {
        $this->checkAuth();
        $this->checkRole([3]);

        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);
        $profileId = $profile['id'] ?? null;

        $availableLessons = $profileId
            ? $this->lessonModel->getAvailableForSwimmer($profileId)
            : [];

        foreach ($availableLessons as &$lesson) {
            $lesson['day_label'] =
                $this->dayLabels[$lesson['day_of_week']] ?? $lesson['day_of_week'];

            $lesson['level_label'] =
                $this->levelLabels[$lesson['level']] ?? $lesson['level'];
        }
        unset($lesson);

        $this->render('swimmer/lessons.view', [
            'title'   => 'Clases Disponibles',
            'lessons' => $availableLessons,
        ]);
    }

    public function book()
    {
        $this->checkAuth();
        $this->checkRole([3]);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Método no permitido.');
        }

        $lessonId = (int) ($_POST['lesson_id'] ?? 0);
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);
        $profileId = $profile['id'] ?? null;

        if ($lessonId <= 0 || !$profileId) {
            return $this->json('warning', 'Datos inválidos.');
        }

        if ($this->lessonModel->isBooked($profileId, $lessonId)) {
            return $this->json('warning', 'Ya estás inscripto en esta clase.');
        }

        $result = $this->lessonModel->book($profileId, $lessonId);

        return $result
            ? $this->json('success', '¡Inscripción exitosa!')
            : $this->json('error', 'No se pudo completar la inscripción.');
    }

    public function cancelBooking()
    {
        $this->checkAuth();
        $this->checkRole([3]);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Método no permitido.');
        }

        $lessonId = (int) ($_POST['lesson_id'] ?? 0);
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);
        $profileId = $profile['id'] ?? null;

        if ($lessonId <= 0 || !$profileId) {
            return $this->json('warning', 'Datos inválidos.');
        }

        $result = $this->lessonModel->cancel($profileId, $lessonId);

        return $result
            ? $this->json('success', 'Inscripción cancelada.')
            : $this->json('error', 'No se pudo cancelar la inscripción.');
    }
}