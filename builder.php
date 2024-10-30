<?php
include_once 'functions.php';  // Include the functions file with database functions

header('Content-Type: application/json'); // Set JSON header

// Handle GET requests to retrieve all builder data
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['id'])) {
    echo json_encode(fetch_all('builders'));  // Fetch all builders as JSON
}

// Handle GET requests to retrieve a specific builder by ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    echo json_encode(fetch_by_id('builders', $_GET['id']));  // Fetch builder with specified ID
}
?>
