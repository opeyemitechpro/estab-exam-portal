<?php
require_once 'app/config/database.php';

try {
    // Create cohort_subjects table
    $sql = "CREATE TABLE IF NOT EXISTS cohort_subjects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cohort_id INT NOT NULL,
        subject_id INT NOT NULL,
        max_score INT DEFAULT 100,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (cohort_id) REFERENCES cohorts(id) ON DELETE CASCADE,
        FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
        UNIQUE KEY unique_cohort_subject (cohort_id, subject_id)
    )";
    
    $pdo->exec($sql);
    echo "Table 'cohort_subjects' created successfully!<br>";
    
    // Check if table exists and show structure
    $stmt = $pdo->query("DESCRIBE cohort_subjects");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Table Structure:</h3>";
    echo "<pre>";
    print_r($columns);
    echo "</pre>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>