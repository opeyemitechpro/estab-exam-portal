<?php
require_once 'app/config/database.php';
require_once 'app/models/CohortSubject.php';

$cohortSubjectModel = new CohortSubject($pdo);

// Test database connection
echo "Database connection: " . ($pdo ? "OK" : "FAILED") . "\n";

// Check if cohort_subjects table exists and has data
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM cohort_subjects");
    $count = $stmt->fetchColumn();
    echo "Total records in cohort_subjects table: $count\n";
    
    // Show all records
    $stmt = $pdo->query("SELECT * FROM cohort_subjects LIMIT 5");
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Sample records:\n";
    print_r($records);
    
    // Test the getByCohort method with a specific cohort ID
    if (isset($_GET['cohort'])) {
        $cohortId = $_GET['cohort'];
        echo "\nTesting getByCohort($cohortId):\n";
        $result = $cohortSubjectModel->getByCohort($cohortId);
        print_r($result);
    }
    
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}
?>