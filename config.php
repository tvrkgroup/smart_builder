<?php
define('DB_SERVER', 'sql306.infinityfree.com');  // Replace with InfinityFree's server
define('DB_USERNAME', 'if0_37634231');           // Replace with your InfinityFree database username
define('DB_PASSWORD', 'iKVQui29WYBrEp0');     // Replace with your InfinityFree database password
define('DB_DATABASE', 'if0_37634231_smart_builder_db'); // Replace with your InfinityFree database name

function connect() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
