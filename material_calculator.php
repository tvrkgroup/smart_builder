<?php
include_once 'functions.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $project_size = $input['project_size'];
    $material_type = $input['material_type'];

    $conn = connect();
    $stmt = $conn->prepare("SELECT cost_per_unit FROM materials WHERE material_type = ?");
    $stmt->bind_param("s", $material_type);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $total_cost = $project_size * $result['cost_per_unit'];
    echo json_encode(["estimated_cost" => $total_cost]);

    $stmt->close();
    $conn->close();
}
?>
