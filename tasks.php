<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'functions.php';
header('Content-Type: application/json');

// Restrict access for non-logged-in users
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

// Handle GET requests to retrieve tasks
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        // Fetch a specific task by ID
        echo json_encode(fetch_by_id('tasks', $_GET['id']));
    } else {
        // Fetch all tasks
        echo json_encode(fetch_all('tasks'));
    }
}

// Handle POST requests to create a new task
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $project_id = $input['project_id'];
    $title = $input['title'];
    $description = $input['description'];
    $status = $input['status'];
    $due_date = $input['due_date'];
    $assigned_to = $input['assigned_to'];

    $conn = connect();
    $stmt = $conn->prepare("INSERT INTO tasks (project_id, title, description, status, due_date, assigned_to) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $project_id, $title, $description, $status, $due_date, $assigned_to);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Task created successfully", "id" => $stmt->insert_id]);
    } else {
        echo json_encode(["error" => "Failed to create task", "error_details" => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}

// Handle PUT requests to update an existing task
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'])) {
    $input = json_decode(file_get_contents("php://input"), true);
    $title = $input['title'];
    $description = $input['description'];
    $status = $input['status'];
    $due_date = $input['due_date'];
    $assigned_to = $input['assigned_to'];

    $conn = connect();
    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, status=?, due_date=?, assigned_to=? WHERE id=?");
    $stmt->bind_param("ssssii", $title, $description, $status, $due_date, $assigned_to, $_GET['id']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Task updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update task"]);
    }

    $stmt->close();
    $conn->close();
}

// Handle DELETE requests to delete a task
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $conn = connect();
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Task deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete task"]);
    }

    $stmt->close();
    $conn->close();
}
?>
