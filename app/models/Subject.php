<?php
require_once __DIR__ . '/../config/database.php';

class Subject {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM exam_subjects ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $max_score) {
        $stmt = $this->pdo->prepare("INSERT INTO exam_subjects (subject_name, max_score) VALUES (?, ?)");
        return $stmt->execute([$name, $max_score]);
    }

     public function getByCohort($cohort_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM exam_subjects WHERE cohort_id = ? ORDER BY subject_name ASC");
        $stmt->execute([$cohort_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $max_score) {
        $stmt = $this->pdo->prepare("UPDATE exam_subjects SET subject_name=?, max_score=? WHERE id=?");
        return $stmt->execute([$name, $max_score, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM exam_subjects WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
