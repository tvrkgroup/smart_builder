<?php
include 'config.php';  // This includes the database connection

$conn = connect();     // Call the connect function to establish a connection

if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed.";
}

$conn->close();        // Close the connection
?>
