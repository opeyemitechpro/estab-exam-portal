<?php
require_once __DIR__ . '/../config/database.php';

class Cohort {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM exam_cohorts ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $year, $date, $passMark) {
        $stmt = $this->pdo->prepare("INSERT INTO exam_cohorts (cohort_name, year, exam_date, pass_mark) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $year, $date, $passMark]);
    }

    // ✅ Fetch all cohorts
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM exam_cohorts ORDER BY year DESC, cohort_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Fetch one cohort by ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM exam_cohorts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $year, $date, $passMark) {
    $stmt = $this->pdo->prepare("UPDATE exam_cohorts 
                                 SET cohort_name = ?, year = ?, exam_date = ?, pass_mark = ? 
                                 WHERE id = ?");
    return $stmt->execute([$name, $year, $date, $passMark, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM exam_cohorts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


?>
