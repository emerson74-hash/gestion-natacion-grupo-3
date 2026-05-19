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
        global $pdo;

        $this->profileModel = new Profile($pdo);
        $this->lessonModel  = new Lesson($pdo);
    }

    // ─── DASHBOARD ────────────────────────────────────────────────────────────

    /**
     * Muestra el panel principal del swimmer.
     * 
     * También carga las clases en las que
     * el usuario está inscripto.
     */
    public function dashboard()
    {
        // Verificamos que el usuario esté logueado
        $this->checkAuth();

        // Verificamos que tenga rol de swimmer
        $this->checkRole([3]);

        // Buscamos el perfil del usuario logueado
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);

        // Guardamos el id del perfil
        $profileId = $profile['id'] ?? null;

        // Obtenemos las clases en las que está inscripto
        $myBookings = $profileId
            ? $this->lessonModel->getBookingsBySwimmer($profileId)
            : [];

        // Renderizamos la vista enviando los datos necesarios
        $this->render('swimmer/dashboard.view', [
            'title'      => 'Mi Panel - Swimming School',
            'user'       => $_SESSION['email'] ?? 'Guest',
            'profile'    => $profile,
            'myBookings' => $myBookings,
        ]);
    }

    // ─── PERFIL ───────────────────────────────────────────────────────────────

    /**
     * Muestra la vista del perfil del swimmer.
     */
    public function profile()
    {
        // Verificamos autenticación y rol
        $this->checkAuth();
        $this->checkRole([3]);

        // Buscamos el perfil del usuario logueado
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);

        // Mostramos la vista con los datos del perfil
        $this->render('swimmer/profile.view', [
            'title'   => 'Mi Perfil',
            'profile' => $profile,
        ]);
    }

    /**
     * Actualiza los datos del perfil.
     * 
     * También permite subir una foto de perfil.
     */
    public function updateProfile()
    {
        // Verificamos autenticación y rol
        $this->checkAuth();
        $this->checkRole([3]);

        // Solo permitimos peticiones POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Método no permitido.');
        }

        // Guardamos los datos enviados desde el formulario
        $data = [
            'user_id'    => $_SESSION['user_id'],
            'phone'      => trim($_POST['phone'] ?? ''),
            'birth_date' => trim($_POST['birth_date'] ?? ''),
        ];

        // Validamos que el teléfono no esté vacío
        if (empty($data['phone'])) {
            return $this->json('warning', 'El teléfono es obligatorio.');
        }

        /**
         * Gestión de imagen de perfil.
         * 
         * Si el usuario sube una imagen válida,
         * se guarda en la carpeta uploads.
         */
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {

            // Carpeta donde se guardan las imágenes
            $uploadDir = __DIR__ . '/../../public/img/uploads/profiles/';

            // Si la carpeta no existe, se crea automáticamente
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Obtenemos la extensión del archivo
            $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));

            // Extensiones permitidas
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            // Verificamos si la extensión es válida
            if (in_array($ext, $allowed)) {

                // Generamos un nombre único para evitar duplicados
                $fileName = 'profile_' . $_SESSION['user_id'] . '_' . rand(1000, 9999) . '.' . $ext;

                // Movemos la imagen a la carpeta correspondiente
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $fileName)) {

                    // Guardamos el nombre de la imagen
                    $data['profile_image'] = $fileName;

                    // Actualizamos la sesión
                    $_SESSION['profile_image'] = $fileName;
                }
            }
        }

        // Actualizamos el perfil en la base de datos
        $updated = $this->profileModel->updateProfile($data);

        // Retornamos una respuesta según el resultado
        return $updated
            ? $this->json('success', 'Perfil actualizado correctamente.')
            : $this->json('error', 'No se pudo actualizar el perfil.');
    }

    // ─── LECCIONES ────────────────────────────────────────────────────────────

    /**
     * Muestra todas las clases disponibles
     * para el swimmer.
     */
    public function lessons()
    {
        // Verificamos autenticación y rol
        $this->checkAuth();
        $this->checkRole([3]);

        // Buscamos el perfil del usuario
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);

        // Guardamos el id del perfil
        $profileId = $profile['id'] ?? null;

        // Obtenemos las clases disponibles
        $availableLessons = $profileId
            ? $this->lessonModel->getAvailableForSwimmer($profileId)
            : [];

        // Mostramos la vista de clases
        $this->render('swimmer/lessons.view', [
            'title'   => 'Clases Disponibles',
            'lessons' => $availableLessons,
        ]);
    }

    /**
     * Inscribe al swimmer en una clase.
     */
    public function book()
    {
        // Verificamos autenticación y rol
        $this->checkAuth();
        $this->checkRole([3]);

        // Solo permitimos peticiones POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Método no permitido.');
        }

        // Obtenemos el id de la clase enviada
        $lessonId = (int) ($_POST['lesson_id'] ?? 0);

        // Buscamos el perfil del usuario
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);

        // Guardamos el id del perfil
        $profileId = $profile['id'] ?? null;

        // Validamos los datos recibidos
        if ($lessonId <= 0 || !$profileId) {
            return $this->json('warning', 'Datos inválidos.');
        }

        // Verificamos si ya está inscripto
        if ($this->lessonModel->isBooked($profileId, $lessonId)) {
            return $this->json('warning', 'Ya estás inscripto en esta clase.');
        }

        // Realizamos la inscripción
        $result = $this->lessonModel->book($profileId, $lessonId);

        // Retornamos una respuesta según el resultado
        return $result
            ? $this->json('success', '¡Inscripción exitosa!')
            : $this->json('error', 'No se pudo completar la inscripción.');
    }

    /**
     * Cancela la inscripción del swimmer
     * a una clase.
     */
    public function cancelBooking()
    {
        // Verificamos autenticación y rol
        $this->checkAuth();
        $this->checkRole([3]);

        // Solo permitimos peticiones POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->json('error', 'Método no permitido.');
        }

        // Obtenemos el id de la clase
        $lessonId = (int) ($_POST['lesson_id'] ?? 0);

        // Buscamos el perfil del usuario
        $profile = $this->profileModel->findByUserId($_SESSION['user_id']);

        // Guardamos el id del perfil
        $profileId = $profile['id'] ?? null;

        // Validamos los datos
        if ($lessonId <= 0 || !$profileId) {
            return $this->json('warning', 'Datos inválidos.');
        }

        // Cancelamos la inscripción
        $result = $this->lessonModel->cancel($profileId, $lessonId);

        // Retornamos una respuesta según el resultado
        return $result
            ? $this->json('success', 'Inscripción cancelada.')
            : $this->json('error', 'No se pudo cancelar la inscripción.');
    }
}