<?php


<<<<<<< HEAD
 
class User {
    private $db;
 
    public function __construct( $pdo ) {
=======

class User
{
    private $db;

    public function __construct($pdo)
    {
>>>>>>> developer

        $this->db = $pdo;
    }

    // --- SECCIÓN: BÚSQUEDA E IDENTIFICACIÓN ---

    /**


    * Busca un usuario por email.
    * @return array|bool Retorna los datos del usuario o false si no existe.
    */
<<<<<<< HEAD
 
    public function findByEmail( $email ) {
        $stmt = $this->db->prepare( 'SELECT * FROM users WHERE email = ? AND deleted_at IS NULL LIMIT 1' );
        $stmt->execute( [ $email ] );
        return $stmt->fetch( PDO::FETCH_ASSOC );
=======

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ? AND deleted_at IS NULL LIMIT 1');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
>>>>>>> developer

    }

    // --- SECCIÓN: GESTIÓN DE CUENTA ---

    /**


    * Crea las credenciales de acceso para un nuevo usuario.
    * @param array $data [ 'email' => string, 'password' => string, 'role_id' => int ]
    */

    public function create(array $data)
    {
        $hash = password_hash($data['password'], PASSWORD_BCRYPT);
        // Usamos el role_id del array, o 3 ( Swimmer ) por defecto si no viene
<<<<<<< HEAD
        $roleId = $data[ 'role_id' ] ?? 3;
 
        $stmt = $this->db->prepare( 'INSERT INTO users (email, password, role_id) VALUES (?, ?, ?)' );
 
        if ( $stmt->execute( [ $data[ 'email' ], $hash, $roleId ] ) ) {
=======
        $roleId = $data['role_id'] ?? 3;

        $stmt = $this->db->prepare('INSERT INTO users (email, password, role_id) VALUES (?, ?, ?)');

        if ($stmt->execute([$data['email'], $hash, $roleId])) {
>>>>>>> developer

            return $this->db->lastInsertId();
        }
        return false;
    }
<<<<<<< HEAD
 //a
=======
    //a
>>>>>>> developer
    /**

     * Valida las credenciales en el inicio de sesión.
     */

    public function login($email, $password)
    {
        // Traemos los datos de users y los datos de perfil de perfiles
<<<<<<< HEAD
        $sql = "SELECT u.*, p.first_name, p.last_name, p.birth_date, p.phone, p.specialty, p.profile_image
=======
        $sql = "SELECT u.*, p.first_name, p.id AS profile_id, p.last_name, p.birth_date, p.phone, p.specialty, p.profile_image

>>>>>>> developer

            FROM users u
            LEFT JOIN profiles p ON u.id = p.user_id AND p.deleted_at IS NULL
            WHERE u.email = ? AND u.deleted_at IS NULL 
            LIMIT 1";


        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;

            // Retorna el array con email, role_id, first_name y profile_image
            return $user;
        }
        return false;
    }

    /**


    * Actualiza la contraseña de un usuario mediante su email.
    */
<<<<<<< HEAD
 
    public function updatePasswordByEmail( $email, $hashedPassword ) {
        $stmt = $this->db->prepare( 'UPDATE users SET password = ? WHERE email = ?' );
        return $stmt->execute( [ $hashedPassword, $email ] );
=======

    public function updatePasswordByEmail($email, $hashedPassword)
    {
        $stmt = $this->db->prepare('UPDATE users SET password = ? WHERE email = ?');
        return $stmt->execute([$hashedPassword, $email]);
>>>>>>> developer

    }

    // --- SECCIÓN: RECUPERACIÓN DE CONTRASEÑA ( TOKENS ) ---

    /**


    * Guarda un token de recuperación, eliminando cualquier token previo del mismo email.
    */

    public function savePasswordToken($email, $token, $expires)
    {
        try {
            // 1. Limpiamos registros de recuperación antiguos para este usuario
            $stmtDel = $this->db->prepare('DELETE FROM password_resets WHERE email = ?');
            $stmtDel->execute([$email]);

            // 2. Insertamos el nuevo token de seguridad
<<<<<<< HEAD
            $stmtIns = $this->db->prepare( 'INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)' );
            return $stmtIns->execute( [ $email, $token, $expires ] );
 
        } catch ( PDOException $e ) {
            error_log( 'Error en savePasswordToken: ' . $e->getMessage() );
=======
            $stmtIns = $this->db->prepare('INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)');
            return $stmtIns->execute([$email, $token, $expires]);

        } catch (PDOException $e) {
            error_log('Error en savePasswordToken: ' . $e->getMessage());
>>>>>>> developer

            return false;
        }
    }

    /**


    * Valida si un token existe y no ha expirado.
    */
<<<<<<< HEAD
 
    public function validateToken( $token ) {
        $stmt = $this->db->prepare( 'SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW() LIMIT 1' );
        $stmt->execute( [ $token ] );
        return $stmt->fetch( PDO::FETCH_ASSOC );
=======

    public function validateToken($token)
    {
        $stmt = $this->db->prepare('SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW() LIMIT 1');
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
>>>>>>> developer

    }

    /**

    * Elimina el token una vez que ya ha sido utilizado.
    */

    public function deleteToken($token)
    {
        $stmt = $this->db->prepare('DELETE FROM password_resets WHERE token = ?');
        return $stmt->execute([$token]);
    }


    //Admin
    //Creamos 1er metodo publico para traer al usuario 

    //Select: Trae TODAS las columnas del user y del profile.
    public function getCoaches()
    {

        $sql = "
        SELECT
          u.id AS user_id,
          p.id AS profile_id,
          u.email,
          u.role_id,
          p.first_name,
          p.last_name,
          p.phone,
          p.specialty,
          p.birth_date
        FROM users u
        INNER JOIN profiles p ON u.id = p.user_id
        WHERE u.role_id = 2
    ";

        /**  ON u.id = p.user_id //Une el usuario con su perfil.
         *   WHERE u.role_id = 2 // rol en la posicion 2, que es el coach.
         *   AND u.deleted_at IS NULL // a usuario que NO estan eliminados.
         */

        //prepara la consulta a SQL por seguridad.
        $stmt = $this->db->prepare($sql);


        if (!$stmt->execute()) {
            var_dump($stmt->errorInfo());
            exit;
        }

        //$stmt->execute(); //ejecuta la consulta SQL.

        return $stmt->fetchAll(PDO::FETCH_ASSOC); //devuelve el resultado del metodo.
        //fetchAll devuelve la cantidad de coaches.
        //FETCH_ASSOC muestra su tipo de dato: id, mail, etc.
    }

    public function createCoach($data)
    {
        //INSERT USER
        $sqlUser = "INSERT INTO users
    (email, password, role_id)
    VALUES (?, ?, ?)";

        $stmtUser = $this->db->prepare($sqlUser);

        $stmtUser->execute([
            $data['email'],
            $data['password'],
            $data['role_id']
        ]);

        //Obtener ID del user creado (Coach)
        $userId = $this->db->lastInsertId();

        //INSERT PROFILE (Datos de la tabla profile de DB)
        $sqlProfile = "INSERT INTO profiles
    (user_id, first_name, last_name, specialty, phone, birth_date, profile_image)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmtProfile = $this->db->prepare($sqlProfile);

        return $stmtProfile->execute([
            $userId,
            $data['first_name'],
            $data['last_name'],
            $data['specialty'],
            $data['phone'],
            $data['birth_date'],
            $data['profile_image']
        ]);
    }

    // Metodo que muestra mensaje en caso de tener el mismo mail dos coaches

    public function emailExists($email)
    {
        $sql = "SELECT id FROM users WHERE email = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$email]);

        return $stmt->fetch();
    }
    public function updateCoachPassword($userId, $password)
    {
        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "UPDATE users
            SET password = ?
            WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $passwordHash,
            $userId
        ]);
    }
    //Metodo para editar al coach en la tabla
    public function getCoachById($id)
    {
        $sql = "SELECT
                users.id,
                users.email,
                profiles.first_name,
                profiles.last_name,
                profiles.specialty,
                profiles.phone,
                profiles.birth_date,
                profiles.profile_image
            FROM users
            INNER JOIN profiles
                ON users.id = profiles.user_id
            WHERE users.id = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCoach($data)
    {
        // UPDATE USERS (Tabla Users)
        $sqlUser = "UPDATE users
                SET email = ?
                WHERE id = ?";

        $stmtUser = $this->db->prepare($sqlUser);

        $stmtUser->execute([
            $data['email'],
            $data['id']
        ]);

        // UPDATE PROFILE (Tabla Profile)
        $sqlProfile = "UPDATE profiles
                   SET first_name = ?,
                       last_name = ?,
                       specialty = ?
                   WHERE user_id = ?";

        $stmtProfile = $this->db->prepare($sqlProfile);

        return $stmtProfile->execute([
            $data['first_name'],
            $data['last_name'],
            $data['specialty'],
            $data['id']
        ]);
    }

    //Metodo para borrar el coach
    public function deleteCoach($id)
    {
        //Primero borrar profile
        $sqlProfile = "DELETE FROM profiles
                   WHERE user_id = ?";

        $stmtProfile = $this->db->prepare($sqlProfile);

        $stmtProfile->execute([$id]);

        //Después borrar user
        $sqlUser = "DELETE FROM users
                WHERE id = ?";

        $stmtUser = $this->db->prepare($sqlUser);

        return $stmtUser->execute([$id]);
    }

    //Admin: Parte Clases

    public function update($data)
    {
        $sql = "UPDATE lessons
            SET level = ?,
                day_of_week = ?,
                start_time = ?,
                end_time = ?,
                capacity = ?,
                profile_id = ?
            WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['level'],
            $data['day_of_week'],
            $data['start_time'],
            $data['end_time'],
            $data['capacity'],
            $data['profile_id'],
            $data['id']
        ]);
    }

    public function getById($id)
    {
        $sql = "SELECT *
            FROM lessons
            WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM lessons WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }


}