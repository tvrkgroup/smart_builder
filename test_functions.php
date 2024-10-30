<?php
include 'functions.php';  // Include the functions file

// Test fetch_all function
echo "<h3>Testing fetch_all for 'customers'</h3>";
$customers = fetch_all('customers');
echo "<pre>";
print_r($customers);
echo "</pre>";

// Test fetch_by_id function
echo "<h3>Testing fetch_by_id for 'customers' with ID 1</h3>";
$customer = fetch_by_id('customers', 1);  // Assuming you have a record with ID 1
echo "<pre>";
print_r($customer);
echo "</pre>";
?>
