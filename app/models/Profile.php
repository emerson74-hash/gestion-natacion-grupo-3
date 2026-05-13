<?php

class Profile {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * Obtiene todos los perfiles con sus correos electrónicos e imagen de perfil.
     */
    public function getAll() {
        // Agregamos p.profile_image a la consulta
        $sql = "SELECT p.*, u.email 
                FROM profiles p 
                INNER JOIN users u ON p.user_id = u.id 
                WHERE p.deleted_at IS NULL";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Inserta los datos personales vinculados a un user_id, incluyendo la imagen.
     * @param array $data ['user_id', 'first_name', 'last_name', 'phone', 'profile_image']
     */
    public function create(array $data) {
        // Agregamos profile_image al INSERT
        $sql = "INSERT INTO profiles (user_id, first_name, last_name, phone, profile_image, birth_date, specialty) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            $data['user_id'],
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            // Si no viene imagen, podemos pasar un null o el nombre por defecto
            $data['profile_image'] ?? 'default-profile.png', 
            $data['birth_date'] ?? null,
            $data['specialty'] ?? null,
        ]);
    }
}