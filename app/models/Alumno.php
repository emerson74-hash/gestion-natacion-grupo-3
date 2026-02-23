<?php
// app/models/Alumno.php

class Alumno {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * Inserta los datos personales vinculados a un usuario_id
     */
    public function create($usuario_id, $nombre, $apellido, $telefono) {
        $stmt = $this->db->prepare("INSERT INTO alumnos (usuario_id, nombre, apellido, telefono) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$usuario_id, $nombre, $apellido, $telefono]);
    }

    /**
     * Obtiene todos los alumnos con sus correos (Join)
     * Ideal para mostrarle a los alumnos cómo se cruzan tablas
     */
    public function getAll() {
        $sql = "SELECT a.*, u.email 
                FROM alumnos a 
                INNER JOIN usuarios u ON a.usuario_id = u.id 
                WHERE a.deleted_at IS NULL";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}