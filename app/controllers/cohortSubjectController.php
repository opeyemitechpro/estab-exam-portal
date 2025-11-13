<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/CohortSubject.php';

$cohortSubject = new CohortSubject($pdo);

// Add subject mapping
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addMapping'])) {
    $cohortId = $_POST['cohort_id'];
    $subjectId = $_POST['subject_id'];
    $maxScore = $_POST['max_score'];

    if (!empty($cohortId) && !empty($subjectId)) {
        try {
            $cohortSubject->addMapping($cohortId, $subjectId, $maxScore);
        } catch (Exception $e) {
            error_log("Error adding subject mapping: " . $e->getMessage());
        }
    }

    header("Location: ../../public/cohort_subjects.php?cohort=" . urlencode($cohortId));
    exit;
}

// Delete mapping
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $cohortId = $_GET['cohort'];
    $cohortSubject->deleteMapping($id);
    header("Location: ../../public/cohort_subjects.php?cohort=" . urlencode($cohortId));
    exit;
}
?>
