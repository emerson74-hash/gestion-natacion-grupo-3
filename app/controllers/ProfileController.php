<?php

class ProfileController
{
    public function __construct($pdo)
    {
        // no hace falta modelo ahora
    }

    public function index()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: ?url=login');
            exit;
        }

        switch ($_SESSION['role_id']) {

            case 1:
                header('Location: ?url=admin');
                break;

            case 2:
                header('Location: ?url=coach/dashboard');
                break;

            case 3:
                header('Location: ?url=swimmer/dashboard');
                break;

            default:
                echo "Rol inválido";
                break;
        }

        exit;
    }
}