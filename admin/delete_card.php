<?php
include '../config/db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM cards WHERE id=$id");

header("Location: dashboard.php");
?>