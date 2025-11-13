<?php

// Database connection configuration variables
$host = "localhost"; // Host name for the MySQL server (usually localhost)
$dbname = "bureau_exam_system"; // Name of the database to connect to
$username = "root"; // Username for the database connection
$password = "";     // Password for the database connection (empty in this case)

// Define the BASE_URL constant if not already defined
// This sets a base URL path for the application, used for linking pages and assets
if (!defined('BASE_URL')) {
    define('BASE_URL', '/php-project-a/estab-exam-portal/');
}

// Define the APP_ROOT constant if not already defined
// This sets the root directory path of the application on the server
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

// Attempt to establish a connection to the MySQL database using PDO
// The PDO object provides a secure, object-oriented way to interact with the database
try {
    // Create a new PDO instance with the specified host, database, and credentials
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set PDO to throw exceptions when database errors occur (useful for debugging)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If the database connection fails, stop execution and display an error message
    die("Database connection failed: " . $e->getMessage());
}

?>
