<?php
require_once __DIR__ . '/../models/Department.php';
$department = new Department($pdo);

// ADD NEW DEPARTMENT
if (isset($_POST['addDepartment'])) {
    $name = trim($_POST['name']);
    $department->create($name);
    header("Location: ../../public/departments.php");
    exit;
}

// DELETE DEPARTMENT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM departments WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: ../../public/departments.php");
    exit;
}
?>
