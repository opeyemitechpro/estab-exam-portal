<?php
require_once __DIR__ . '/../config/database.php';

class Dashboard {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Total staff count
    public function totalStaff() {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM staff");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Total candidates (staff who took exams)
    public function totalCandidates() {
        $stmt = $this->pdo->query("SELECT COUNT(DISTINCT staff_id) AS total FROM exam_scores");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Passed count (based on passing rule)
    public function totalPassed() {
        $stmt = $this->pdo->query("
            SELECT COUNT(DISTINCT staff_id) AS total
            FROM exam_scores
            WHERE total_score >= (
                SELECT pass_mark FROM exam_cohorts ORDER BY id DESC LIMIT 1
            )
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Failed count
    public function totalFailed() {
        $stmt = $this->pdo->query("
            SELECT COUNT(DISTINCT staff_id) AS total
            FROM exam_scores
            WHERE total_score < (
                SELECT pass_mark FROM exam_cohorts ORDER BY id DESC LIMIT 1
            )
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Absent (staff without scores in current cohort)
    public function totalAbsent() {
        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS total 
            FROM staff 
            WHERE id NOT IN (
                SELECT DISTINCT staff_id FROM exam_scores
            )
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Recent exam results (latest 5)
    public function recentResults() {
        $stmt = $this->pdo->query("
            SELECT s.id AS staff_id, s.full_name, d.dept_name AS department, e.total_score,
                CASE 
                    WHEN e.total_score >= (
                        SELECT pass_mark FROM exam_cohorts ORDER BY id DESC LIMIT 1
                    ) THEN 'Pass'
                    ELSE 'Fail'
                END AS status
            FROM exam_scores e
            JOIN staff s ON e.staff_id = s.id
            LEFT JOIN departments d ON s.department_id = d.id
            ORDER BY e.created_at DESC
            LIMIT 5
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
