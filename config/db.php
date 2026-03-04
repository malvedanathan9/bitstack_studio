<?php
$host = "localhost";      // MySQL host
$db   = "visit_system";   // Database name you created
$user = "root";           // Default XAMPP username
$pass = "";               // Default XAMPP password is empty

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

