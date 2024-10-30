<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Return a response confirming logout
header('Content-Type: application/json');
echo json_encode(["message" => "Logout successful"]);
?>
