<?php
class Database {
    private $host = "localhost"; 
    private $dbname = "studentManagement"; // Change this to your actual database name
    private $username = "root"; // Change if your MySQL has a different username
    private $password = ""; // Change if your MySQL has a password
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
