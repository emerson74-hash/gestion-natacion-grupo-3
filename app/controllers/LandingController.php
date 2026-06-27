<?php

require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../services/MailService.php';

class LandingController extends BaseController
{
public function index()
{
    $user = null;

    if (isset($_SESSION['user_id'])) {
        $user = [
            'first_name' => $_SESSION['first_name'] ?? '',
            'role_id' => $_SESSION['role_id'] ?? null
        ];
    }

    require_once __DIR__ . '/../views/landing.view.php';
}


public function sendContact()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit;
    }

    $nombre  = trim($_POST['nombre']  ?? '');
    $email   = trim($_POST['email']   ?? '');
    $motivo  = trim($_POST['motivo']  ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo json_encode(['success' => false, 'message' => 'Completá todos los campos.']);
        exit;
    }

    $mailService = new MailService();
$ok = $mailService->sendContactMessage($nombre, $email, $motivo, $mensaje);

header('Content-Type: application/json');

if ($ok) {
    echo json_encode(['success' => true, 'message' => '¡Gracias! Nos ponemos en contacto pronto.']);
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo enviar la consulta. Intentá más tarde.']);
}
exit;
}
}