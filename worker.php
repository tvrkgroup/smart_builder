<?php
include_once 'functions.php';  // Include the functions file with database functions

header('Content-Type: application/json'); // Set JSON header for API responses

// Handle GET requests to retrieve all worker data
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['id'])) {
    echo json_encode(fetch_all('workers'));  // Fetch all workers as JSON
}

// Handle GET requests to retrieve a specific worker by ID
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    echo json_encode(fetch_by_id('workers', $_GET['id']));  // Fetch worker with specified ID
}
?>
