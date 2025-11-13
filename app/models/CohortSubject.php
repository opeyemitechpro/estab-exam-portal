<?php
class CohortSubject {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getByCohort($cohortId) {
        $stmt = $this->pdo->prepare("
            SELECT cs.id, s.subject_name, cs.max_score
            FROM cohort_subjects cs
            JOIN subjects s ON cs.subject_id = s.id
            WHERE cs.cohort_id = ?
        ");
        $stmt->execute([$cohortId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMapping($cohortId, $subjectId, $maxScore) {
        try {
            // Check if mapping already exists
            $checkStmt = $this->pdo->prepare("
                SELECT COUNT(*) FROM cohort_subjects 
                WHERE cohort_id = ? AND subject_id = ?
            ");
            $checkStmt->execute([$cohortId, $subjectId]);
            
            if ($checkStmt->fetchColumn() > 0) {
                throw new Exception("Subject is already mapped to this cohort");
            }
            
            $stmt = $this->pdo->prepare("
                INSERT INTO cohort_subjects (cohort_id, subject_id, max_score)
                VALUES (?, ?, ?)
            ");
            return $stmt->execute([$cohortId, $subjectId, $maxScore]);
        } catch (PDOException $e) {
            error_log("Database error in addMapping: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteMapping($id) {
        $stmt = $this->pdo->prepare("DELETE FROM cohort_subjects WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
