<?php
class StudentModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllStudents() {
        $query = "SELECT * FROM students ORDER BY id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createStudent($student_name, $student_id, $email) {
        $query = "INSERT INTO students (student_name, student_id, email) VALUES (:student_name, :student_id, :email)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':student_name', $student_name);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':email', $email);
        
        return $stmt->execute();
    }

    public function deleteStudent($id) {
        $query = "DELETE FROM students WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
