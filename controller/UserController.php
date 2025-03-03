<?php
require_once 'model/UserModel.php';

class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $this->db->prepare("SELECT id, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: index.php?page=students");
                exit();
            } else {
                $_SESSION['login_error'] = "Invalid email or password!";
                header("Location: index.php?page=login");
                exit();
            }
        } else {
            include "view/login.php";
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            // Check if email already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $_SESSION['register_error'] = "Email already exists!";
                header("Location: index.php?page=register");
                exit();
            }
    
            // Insert new user
            $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $password])) {
                $_SESSION['register_success'] = "Registration successful! You can now log in.";
                header("Location: index.php?page=login");
                exit();
            } else {
                $_SESSION['register_error'] = "Registration failed. Please try again.";
                header("Location: index.php?page=register");
                exit();
            }
        } else {
            include 'view/register.php';
        }
    }
    

    public function logout() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header("Location: index.php?page=login");
        exit();
    }
}

?>
