<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/Database.php';
require_once 'controller/StudentController.php';
require_once 'controller/UserController.php';

// Initialize database
$database = new Database();
$db = $database->getConnection();

// Initialize controllers
$studentController = new StudentController($db);
$userController = new UserController($db);

// Handle routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if (!isset($_SESSION['user_id']) && !in_array($page, ['login', 'register'])) {
    header("Location: index.php?page=login");
    exit();
}

switch ($page) {
    case 'login':
        $userController->login();
        break;

    case 'register':
        $userController->register();
        break;

    case 'logout':
        $userController->logout();
        break;

    case 'students':
        $studentController->index();
        break;

    case 'add_student':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentController->addStudent();
        }
        break;

    case 'delete_student':
        if (isset($_GET['id'])) {
            $studentController->deleteStudent();
        }
        break;

    default:
        echo "Page not found!";
}
?>
