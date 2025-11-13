<?php
require_once __DIR__ . '/../models/ExamScore.php';
$score = new ExamScore($pdo);

// AJAX: Save or update score
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'saveScore') {
    $staffId = $_POST['staff_id'];
    $cohortId = $_POST['cohort_id'];
    $subjectId = $_POST['subject_id'];
    $scoreValue = $_POST['score'];

    $result = $score->saveOrUpdate($staffId, $cohortId, $subjectId, $scoreValue);
    echo json_encode(['success' => $result]);
    exit;
}

// AJAX: Delete score
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $score->delete($id);
    header("Location: ../../public/exam_scores.php");
    exit;
}
?>
