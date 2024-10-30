<?php
include_once 'config.php';  // Include the database connection file

// Function to fetch all data from a specified table
function fetch_all($table) {
    $conn = connect();
    $query = "SELECT * FROM $table";  // SQL query to select all records
    $result = $conn->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    return $data;
}

// Function to fetch data by ID from a specified table
function fetch_by_id($table, $id) {
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);     // Bind the ID parameter to the query
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $result;
}
?>
