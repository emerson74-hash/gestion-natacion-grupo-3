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
            header('Location: ?url=landing');
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $motivo = trim($_POST['motivo'] ?? '');
        $mensaje = trim($_POST['mensaje'] ?? '');

        $mailService = new MailService();

        $ok = $mailService->sendContactMessage(
            $nombre,
            $email,
            $motivo,
            $mensaje
        );

        if ($ok) {
            $_SESSION['success'] = 'Tu consulta fue enviada correctamente.';
        } else {
            $_SESSION['error'] = 'No se pudo enviar la consulta.';
        }

        header('Location: ?url=landing#contacto');
        exit;
    }
}