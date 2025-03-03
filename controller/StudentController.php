<?php
require_once 'model/StudentModel.php';

class StudentController {
    private $db;
    private $studentModel;

    public function __construct($db) {
        $this->db = $db;
        $this->studentModel = new StudentModel($this->db);
    }

    public function index() {
        $students = $this->studentModel->getAllStudents();
        include 'view/students.php';
    }

    public function addStudent() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["student_name"];
            $email = $_POST["email"];
            $this->studentModel->addStudent($name, $email);
            header("Location: index.php?page=students");
        }
    }

    public function deleteStudent() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->studentModel->deleteStudent($id);
            header("Location: index.php?page=students");
        }
    }
}
?>
