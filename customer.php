// Update an existing customer
if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'])) {
    $input = json_decode(file_get_contents("php://input"), true);
    $name = $input['name'];
    $project_status = $input['project_status'];
    $contact_info = $input['contact_info'];
    $cctv_link = $input['cctv_link'];

    $conn = connect();
    $stmt = $conn->prepare("UPDATE customers SET name=?, project_status=?, contact_info=?, cctv_link=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $project_status, $contact_info, $cctv_link, $_GET['id']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Customer updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update customer"]);
    }

    $stmt->close();
    $conn->close();
}

// Delete a customer
if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
    $conn = connect();
    $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Customer deleted successfully"]);
    } else {
        echo json_encode(["error" => "Failed to delete customer"]);
    }

    $stmt->close();
    $conn->close();
}
