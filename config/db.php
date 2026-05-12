<?php
$conn = new mysqli("localhost", "root", "", "parking_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>