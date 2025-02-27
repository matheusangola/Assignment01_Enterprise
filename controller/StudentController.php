<?php
require_once 'model/StudentModel.php';

class StudentController {
    private $studentModel;

    public function __construct($db) {
        $this->studentModel = new StudentModel($db);
    }

    // Display all students
    public function index() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        $students = $this->studentModel->getAllStudents();
        include 'views/students.php'; // Load the students view
    }

    // Handle adding a new student
    public function addStudent() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_name = $_POST['student_name'];
            $student_id = $_POST['student_id'];
            $email = $_POST['email'];

            if (!empty($student_name) && !empty($student_id) && !empty($email)) {
                $this->studentModel->createStudent($student_name, $student_id, $email);
                header("Location: students.php");
                exit();
            } else {
                echo "All fields are required.";
            }
        }
    }

    // Handle deleting a student
    public function deleteStudent() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->studentModel->deleteStudent($id);
        }

        header("Location: students.php");
        exit();
    }
}
?>
