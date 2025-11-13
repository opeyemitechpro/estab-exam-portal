<?php
require_once __DIR__ . '/../config/database.php';

class ExamScore {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all scores for a specific cohort
    public function getByCohort($cohortId) {
        $stmt = $this->pdo->prepare("
            SELECT e.id as score_id, st.id as staff_id, st.full_name, d.dept_name as department, 
                   cs.subject_id, cs.id as subject_id, e.score
            FROM exam_scores e
            JOIN staff st ON e.staff_id = st.id
            JOIN departments d ON st.department_id = d.id
            JOIN cohort_subjects cs ON e.subject_id = cs.id
            WHERE e.cohort_id = ?
            ORDER BY st.full_name ASC
        ");
        $stmt->execute([$cohortId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create or update a score
    public function saveOrUpdate($staffId, $cohortId, $subjectId, $score) {
        $stmt = $this->pdo->prepare("
            INSERT INTO exam_scores (staff_id, cohort_id, subject_id, score)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE score = VALUES(score)
        ");
        return $stmt->execute([$staffId, $cohortId, $subjectId, $score]);
    }

    // Delete a score
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM exam_scores WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
