<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'clothing';


// Create Connection
$conn = new mysqli($servername, $username, $password, $db);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected Successfully"
?>
