<?php
require_once __DIR__ . '/../models/Subject.php';
require_once __DIR__ . '/../config/database.php';


$subjectModel = new Subject($pdo);

// ADD SUBJECT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addSubject'])) {
    $name = $_POST['subject_name'];
    $max_score = $_POST['max_score'];
    $subjectModel->create($name, $max_score);
    header("Location: /php-project-a/estab-exam-portal/public/subjects.php");
    exit;
}

// UPDATE SUBJECT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateSubject'])) {
    $id = $_POST['id'];
    $name = $_POST['subject_name'];
    $max_score = $_POST['max_score'];
    $subjectModel->update($id, $name, $max_score);
    header("Location: /php-project-a/estab-exam-portal/public/subjects.php");
    exit;
}

// DELETE SUBJECT
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $subjectModel->delete($id);
    header("Location: /php-project-a/estab-exam-portal/public/subjects.php");
    exit;
}

// Inline edit (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateField') {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $allowed = ['subject_name', 'max_score'];
    if (!in_array($field, $allowed)) {
        echo json_encode(['success' => false, 'error' => 'Invalid field']);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE exam_subjects SET $field = ? WHERE id = ?");
    $ok = $stmt->execute([$value, $id]);
    echo json_encode(['success' => $ok]);
    exit;
}


?>
