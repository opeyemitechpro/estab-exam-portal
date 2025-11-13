<?php
require_once __DIR__ . '/../models/Cohort.php';
$cohort = new Cohort($pdo);

// CREATE COHORT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCohort'])) {
    $name = $_POST['cohort_name'];
    $year = $_POST['year'];
    $date = $_POST['exam_date'];
    $pass = $_POST['pass_mark'];

    $cohort->create($name, $year, $date, $pass);
    header("Location: ../../public/cohorts.php");
    exit;
}

// UPDATE COHORT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateCohort'])) {
    $id = $_POST['id'];
    $name = $_POST['cohort_name'];
    $year = $_POST['year'];
    $date = $_POST['exam_date'];
    $pass = $_POST['pass_mark'];

    $cohort->update($id, $name, $year, $date, $pass);
    header("Location: " . BASE_URL . "public/cohorts.php");
    exit;
}

// DELETE COHORT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $cohort->delete($id);
    header("Location: " . BASE_URL . "public/cohorts.php");
    exit;
}
?>
