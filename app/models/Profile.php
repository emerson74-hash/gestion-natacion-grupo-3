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
     * Obtiene solo los perfiles de Swimmers ( specialty IS NULL ).
     * Se usa en el SwimmerController y en el Admin para listar alumnos.
     */
    public function getAllSwimmers() {
        // Filtramos por specialty NULL para distinguir swimmers de coaches
        $sql = "SELECT p.*, u.email 
                FROM profiles p 
                INNER JOIN users u ON p.user_id = u.id 
                WHERE p.specialty IS NULL AND p.deleted_at IS NULL
                ORDER BY p.last_name, p.first_name";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
    /**
     * Obtiene solo los perfiles de Coaches ( specialty IS NOT NULL ).
     * Se usa en el CoachController y en el Admin para listar profesores.
     */
    public function getAllCoaches() {
        // Filtramos por specialty para distinguir coaches de swimmers
        $sql = "SELECT p.*, u.email 
                FROM profiles p 
                INNER JOIN users u ON p.user_id = u.id 
                WHERE p.specialty IS NOT NULL AND p.deleted_at IS NULL
                ORDER BY p.last_name, p.first_name";
        
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
            // specialty NULL = Swimmer | specialty con valor = Coach
            $data['specialty'] ?? null,
        ]);
    }
 
    /**
     * Busca el perfil completo de un usuario por su user_id de sesión.
     * Retorna también profiles.id que se necesita para bookings y lessons.
     * @param int $userId  users.id ( el que se guarda en $_SESSION['user_id'] )
     */
    public function findByUserId(int $userId): ?array {
        $sql = "SELECT p.*, u.email
                FROM profiles p
                INNER JOIN users u ON p.user_id = u.id
                WHERE p.user_id = ? AND p.deleted_at IS NULL
                LIMIT 1";
 
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // Retornamos null si no existe el perfil, para manejarlo limpiamente en el controller
        return $row ?: null;
    }
 
    /**
     * Actualiza los datos personales editables del perfil.
     * Si viene nueva foto de perfil la actualiza, si no, la deja como está.
     * @param array $data ['user_id', 'phone', 'birth_date', 'profile_image'?]
     */
    public function updateProfile(array $data) {
        // Construimos la query dinámicamente según si viene o no una nueva imagen
        if (!empty($data['profile_image'])) {
            $sql = "UPDATE profiles 
                    SET phone = ?, birth_date = ?, profile_image = ?
                    WHERE user_id = ?";
 
            $params = [
                $data['phone'],
                $data['birth_date'] ?? null,
                $data['profile_image'],
                $data['user_id']
            ];
        } else {
            // Si no viene imagen, no la tocamos para no pisar la anterior
            $sql = "UPDATE profiles 
                    SET phone = ?, birth_date = ?
                    WHERE user_id = ?";
 
            $params = [
                $data['phone'],
                $data['birth_date'] ?? null,
                $data['user_id']
            ];
        }
 
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}
 