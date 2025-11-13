<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Staff.php';

$staffModel = new Staff($pdo);

// ADD STAFF
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addStaff'])) {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['full_name'];
    $department_id = $_POST['department_id'] ?? null;
    $status = $_POST['status'];

    $staffModel->create($staff_id, $name, $department_id, $status);

    header("Location: ../../public/staff.php");
    exit;
}

// UPDATE STAFF
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateStaff'])) {
    $id = $_POST['id'];
    $staff_id = $_POST['staff_id'];
    $name = $_POST['full_name'];
    $department_id = $_POST['department_id'] ?? null;
    $status = $_POST['status'];

    $staffModel->update($id, $staff_id, $name, $department_id, $status);

    header("Location: ../../public/staff.php");
    exit;
}

// DELETE STAFF
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $staffModel->delete($id);
    header("Location: ../../public/staff.php");
    exit;
}
?>
