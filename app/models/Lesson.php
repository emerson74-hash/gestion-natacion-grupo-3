<?php

/**
 * modelo encargado de gestionar las clases de natación y
 * las inscripciones de los alumnos.
 * Una clase pertenece a un instructor.
 * Un alumno puede inscribirse a una o varias clases.
 * y las inscripciones pueden estar activas o canceladas.
 */
class Lesson
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }


     /**
     * obtiene todas las clases disponibles junto con
     *  datos del instructor
     *  cantidad de alumnos inscriptos
     *  estado de inscripción del alumno actual
     * @return array
     */
    public function getAvailableForSwimmer(int $swimmerProfileId): array
    {
        $sql = "SELECT
                    l.id,
                    l.level,
                    l.day_of_week,
                    l.start_time,
                    l.end_time,
                    l.capacity,
                    CONCAT(coach.first_name, ' ', coach.last_name) AS coach_name,
                    coach.specialty                                AS coach_specialty,
                    COUNT(b.id)                                    AS booked_count,
                    MAX(CASE WHEN b.profile_id = ? AND b.status = 'Confirmed' THEN 1 ELSE 0 END) AS is_booked
                FROM lessons l
                INNER JOIN profiles coach ON l.profile_id = coach.id
                LEFT  JOIN bookings b ON l.id = b.lesson_id AND b.status = 'Confirmed'
                GROUP BY l.id
                ORDER BY
                    FIELD(l.day_of_week,
                        'Monday','Tuesday','Wednesday',
                        'Thursday','Friday','Saturday'),
                    l.start_time";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$swimmerProfileId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * obtiene las clases en las que un alumno
     * se encuentra actualmente inscripto.
     * @return array
     */
    public function getBookingsBySwimmer(int $swimmerProfileId): array
    {
        $sql = "SELECT
                    l.id,
                    l.level,
                    l.day_of_week,
                    l.start_time,
                    l.end_time,
                    CONCAT(coach.first_name, ' ', coach.last_name) AS coach_name,
                    b.status
                FROM bookings b
                INNER JOIN lessons  l     ON b.lesson_id  = l.id
                INNER JOIN profiles coach ON l.profile_id = coach.id
                WHERE b.profile_id = ? AND b.status = 'Confirmed'
                ORDER BY
                    FIELD(l.day_of_week,
                        'Monday','Tuesday','Wednesday',
                        'Thursday','Friday','Saturday'),
                    l.start_time";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$swimmerProfileId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /**
     * obtiene las clases asignadas a un instructor
     * junto con la cantidad de alumnos inscriptos.
     * @return array
     */
    public function getByCoach(int $coachProfileId): array
    {
        $sql = "SELECT l.*, COUNT(b.id) AS booked_count
                FROM lessons l
                LEFT JOIN bookings b ON l.id = b.lesson_id AND b.status = 'Confirmed'
                WHERE l.profile_id = ?
                GROUP BY l.id
                ORDER BY
                    FIELD(l.day_of_week,
                        'Monday','Tuesday','Wednesday',
                        'Thursday','Friday','Saturday'),
                    l.start_time";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$coachProfileId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     /**
     * obtiene todas las clases registradas en el sistema
     * junto con el instructor correspondiente y la cantidad
     * de alumnos inscriptos.
     * @return array
     */
    public function getAll(): array
    {
        $sql = "SELECT
                    l.*,
                    CONCAT(coach.first_name, ' ', coach.last_name) AS coach_name,
                    COUNT(b.id) AS booked_count
                FROM lessons l
                INNER JOIN profiles coach ON l.profile_id = coach.id
                LEFT  JOIN bookings b ON l.id = b.lesson_id AND b.status = 'Confirmed'
                GROUP BY l.id
                ORDER BY
                    FIELD(l.day_of_week,
                        'Monday','Tuesday','Wednesday',
                        'Thursday','Friday','Saturday'),
                    l.start_time";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

     /**
     * verifica si un alumno ya se encuentra
     * inscripto en una clase.
     * @return bool para verificar si sí o no.
     */
    public function isBooked(int $swimmerProfileId, int $lessonId): bool
    {
        $sql  = "SELECT id FROM bookings
                 WHERE profile_id = ? AND lesson_id = ? AND status = 'Confirmed'
                 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$swimmerProfileId, $lessonId]);
        return (bool) $stmt->fetch();
    }

    
     /**
     * registra una clase nueva en el sistema.
     * @return bool
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO lessons (level, day_of_week, start_time, end_time, capacity, profile_id)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['level'],
            $data['day_of_week'],
            $data['start_time'],
            $data['end_time'],
            $data['capacity'] ?? 20,
            $data['profile_id'],
        ]);
    }

    /**
     * Inscribe a un alumno en una clase.
     * Si la inscripción ya existía y estaba cancelada,
     * se reactiva automáticamente.
     * @return bool
     */
    public function book(int $swimmerProfileId, int $lessonId): bool
    {
        $existing = $this->db->prepare(
            "SELECT id FROM bookings WHERE profile_id = ? AND lesson_id = ? LIMIT 1"
        );
        $existing->execute([$swimmerProfileId, $lessonId]);

        if ($existing->fetch()) {
            $stmt = $this->db->prepare(
                "UPDATE bookings SET status = 'Confirmed' WHERE profile_id = ? AND lesson_id = ?"
            );
            return $stmt->execute([$swimmerProfileId, $lessonId]);
        }

        $stmt = $this->db->prepare(
            "INSERT INTO bookings (profile_id, lesson_id, status) VALUES (?, ?, 'Confirmed')"
        );
        return $stmt->execute([$swimmerProfileId, $lessonId]);
    }

    /**
     * cancela la inscripción de un alumno a una clase.
     * La inscripción no se elimina físicamente,
     * solo cambia su estado a cancelado.
     * @return bool
     */
    public function cancel(int $swimmerProfileId, int $lessonId): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE bookings SET status = 'Cancelled' WHERE profile_id = ? AND lesson_id = ?"
        );
        return $stmt->execute([$swimmerProfileId, $lessonId]);
    }
}
