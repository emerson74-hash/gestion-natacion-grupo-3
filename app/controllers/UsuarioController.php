<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Alumno.php';

class UsuarioController extends BaseController {
    private $usuarioModel;
    private $alumnoModel;
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
        $this->usuarioModel = new Usuario( $pdo );
        $this->alumnoModel = new Alumno( $pdo );
    }

    /**
    * Muestra la lista de alumnos
    */

    // app/controllers/UsuarioController.php

    public function index() {
        $this->checkAuth();
        // Si no está logueado, lo saca eyectado al login

        $alumnos = $this->alumnoModel->getAll();
        $this->render( 'usuarios/index', [ 'alumnos' => $alumnos ] );
    }

    /**
    * Gestiona el registro ( GET para vista / POST para API )
    */

    public function register() {
        // Si no es POST, simplemente mostramos el formulario
        if ( $_SERVER[ 'REQUEST_METHOD' ] !== 'POST' ) {
            return $this->render( 'usuarios/register', [ 'titulo'=>'Inscripción de Alumnos' ] );
        }

        // 1. Recolección y Limpieza ( Sanitización )
        $fields = [
            'nombre'   => trim( $_POST[ 'nombre' ] ?? '' ),
            'apellido' => trim( $_POST[ 'apellido' ] ?? '' ),
            'email'    => trim( $_POST[ 'email' ] ?? '' ),
            'pass'     => $_POST[ 'password' ] ?? '',
            'tel'      => trim( $_POST[ 'telefono' ] ?? '' )
        ];

        // 2. Validaciones Críticas ( Early Returns )
        if ( $this->hasEmptyFields( $fields ) ) {
            return $this->json( 'warning', 'Faltan datos obligatorios.' );
        }

        if ( !filter_var( $fields[ 'email' ], FILTER_VALIDATE_EMAIL ) ) {
            return $this->json( 'error', 'El email ingresado no es válido.' );
        }

        if ( strlen( $fields[ 'pass' ] ) < 6 ) {
            return $this->json( 'warning', 'La contraseña es muy corta (mín. 6 caracteres).' );
        }


        // 3. Ejecución de Lógica de Negocio
        return $this->executeRegistration( $fields );
    }

    /**
    * Lógica privada para procesar el alta ( Transacción )
    */

    private function executeRegistration( $f ) {
        try {
            // 1. Verificamos proactivamente si el usuario ya existe
            if ( $this->usuarioModel->exists( $f[ 'email' ] ) ) {
                // Mandamos a la Home para que busque el botón de ingresar
                return $this->json( 'user_exists', 'Ya tienes una cuenta registrada con este correo.', '?url=login' );
            }

            // 2. Si no existe, procedemos con la transacción
            $this->pdo->beginTransaction();

            $u_id = $this->usuarioModel->create( $f[ 'email' ], $f[ 'pass' ], 3 );
            if ( !$u_id ) throw new Exception( 'Error al crear credenciales.' );

            $this->alumnoModel->create( $u_id, $f[ 'nombre' ], $f[ 'apellido' ], $f[ 'tel' ] );

            $this->pdo->commit();

            // 3. Registro exitoso -> Al Login
            return $this->json( 'success', '¡Registro completado! Ahora puedes iniciar sesión.', '?url=login' );

        } catch ( Exception $e ) {
            if ( $this->pdo->inTransaction() ) {
                $this->pdo->rollBack();
            }
            return $this->json( 'error', 'No se pudo completar el registro: ' . $e->getMessage() );
        }
    }

    public function showLogin() {
        $this->render( 'usuarios/login' );
    }

    public function auth() {
        if ( $_SERVER[ 'REQUEST_METHOD' ] !== 'POST' ) {
            return $this->json( 'error', 'Acceso no permitido.' );
        }

        $email = trim( $_POST[ 'email' ] ?? '' );
        $pass  = $_POST[ 'password' ] ?? '';

        if ( empty( $email ) || empty( $pass ) ) {
            return $this->json( 'warning', 'Ingresa tus credenciales.' );
        }

        $user = $this->usuarioModel->login( $email, $pass );

        if ( $user ) {
            // Iniciamos sesión y guardamos datos clave
            session_start();
            $_SESSION[ 'user_id' ] = $user[ 'id' ];
            $_SESSION[ 'rol_id' ]  = $user[ 'rol_id' ];
            $_SESSION[ 'email' ]   = $user[ 'email' ];

            return $this->json( 'success', '¡Bienvenido al sistema!', '?url=home' );
        }

        return $this->json( 'error', 'Credenciales incorrectas. Intentá de nuevo.' );
    }

    /**
    * Helper para chequear campos vacíos
    */

    private function hasEmptyFields( $f ) {
        return empty( $f[ 'nombre' ] ) || empty( $f[ 'apellido' ] ) || empty( $f[ 'email' ] ) || empty( $f[ 'pass' ] );
    }
}