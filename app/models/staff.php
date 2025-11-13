<?php
require_once __DIR__ . '/../config/database.php';

class Staff {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // public function getAll() {
    //     $stmt = $this->pdo->query("SELECT * FROM staff ORDER BY id DESC");
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getAll() {
    $stmt = $this->pdo->query("
        SELECT s.id, s.staff_id, s.full_name, s.status,
               d.dept_name AS department
        FROM staff s
        LEFT JOIN departments d ON s.department_id = d.id
        ORDER BY s.full_name ASC
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM staff WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function create($staff_id, $name, $dept, $status) {
    //     $stmt = $this->pdo->prepare("INSERT INTO staff (staff_id, full_name, department, status) VALUES (?, ?, ?, ?)");
    //     return $stmt->execute([$staff_id, $name, $dept, $status]);
    // }

    // public function update($id, $staff_id, $name, $dept, $status) {
    //     $stmt = $this->pdo->prepare("UPDATE staff SET staff_id=?, full_name=?, department=?, status=? WHERE id=?");
    //     return $stmt->execute([$staff_id, $name, $dept, $status, $id]);
    // }

    public function create($staff_id, $full_name, $department_id, $status) {
    $stmt = $this->pdo->prepare("INSERT INTO staff (staff_id, full_name, department_id, status) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$staff_id, $full_name, $department_id, $status]);
}

public function update($id, $staff_id, $full_name, $department_id, $status) {
    $stmt = $this->pdo->prepare("UPDATE staff SET staff_id = ?, full_name = ?, department_id = ?, status = ? WHERE id = ?");
    return $stmt->execute([$staff_id, $full_name, $department_id, $status, $id]);
}


    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM staff WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
