<?php
// app/models/Usuario.php

class Usuario {
    private $db;

    public function __construct( $pdo ) {
        $this->db = $pdo;
    }

    /**
    * Verifica si el email ya existe en la DB
    */

    public function exists( $email ) {
        $stmt = $this->db->prepare( 'SELECT id FROM usuarios WHERE email = ? AND deleted_at IS NULL' );
        $stmt->execute( [ $email ] );
        return $stmt->fetch() ? true : false;
    }

    /**
    * Crea la credencial de acceso
    */

    public function create( $email, $password, $rol_id = 3 ) {
        $hash = password_hash( $password, PASSWORD_BCRYPT );
        $stmt = $this->db->prepare( 'INSERT INTO usuarios (email, password, rol_id) VALUES (?, ?, ?)' );

        if ( $stmt->execute( [ $email, $hash, $rol_id ] ) ) {
            return $this->db->lastInsertId();
            // Devolvemos el ID generado
        }
        return false;
    }

    public function login( $email, $password ) {
        $stmt = $this->db->prepare( 'SELECT * FROM usuarios WHERE email = ? AND deleted_at IS NULL' );
        $stmt->execute( [ $email ] );
        $user = $stmt->fetch( PDO::FETCH_ASSOC );

        // Verificamos si existe el usuario y si la contraseña coincide con el hash
        if ( $user && password_verify( $password, $user[ 'password' ] ) ) {
            return $user;
        }
        return false;
    }
}