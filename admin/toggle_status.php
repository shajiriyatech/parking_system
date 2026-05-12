<?php
include '../config/db.php';

session_start();

if($_SESSION['role'] != 'manager'){
    die('Access Denied');
}

if(isset($_POST['confirm_block'])){

    $id = $_POST['card_id'];
    $reason = $_POST['block_reason'];

    $sql = "
    UPDATE cards
    SET
    status='blocked',
    block_reason='$reason'
    WHERE id='$id'
    ";

    $conn->query($sql);
}
if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "
    UPDATE cards
    SET
    status='active',
    block_reason=NULL
    WHERE id='$id'
    ";

    $conn->query($sql);
}

header('Location: dashboard.php');
?>