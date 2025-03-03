<?php
class StudentModel {
    private $db;

    public function __construct($db) {
        if (!$db) {
            die("Database connection failed!");
        }
        $this->db = $db;
    }

    public function getAllStudents() {
        $stmt = $this->db->prepare("SELECT id, student_name, email, student_id FROM students");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStudent($name, $email) {
        $query = "SELECT MAX(id) AS max_id FROM students";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $nextId = $row['max_id'] + 1;
    
        $studentId = "S" . str_pad($nextId, 3, '0', STR_PAD_LEFT);
    
        $query = "INSERT INTO students (student_id, student_name, email) VALUES (:student_id, :student_name, :email)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':student_id' => $studentId,
            ':student_name' => $name,
            ':email' => $email
        ]);
        return true;
    }
    
    public function deleteStudent($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
