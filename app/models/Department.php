<?php
require_once __DIR__ . '/../config/database.php';

class Department {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM departments ORDER BY dept_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name) {
        $stmt = $this->pdo->prepare("INSERT INTO departments (dept_name) VALUES (?)");
        return $stmt->execute([$name]);
    }
}
?>
