<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');  // Default username for XAMPP
define('DB_PASSWORD', '');      // Default password for XAMPP is empty
define('DB_DATABASE', 'construction_db');  // Ensure this matches the actual database name

function connect() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
