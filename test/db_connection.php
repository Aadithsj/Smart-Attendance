<?php
// Database configuration
$db_host     = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name     = 'sap';

// Create a new MySQLi connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
