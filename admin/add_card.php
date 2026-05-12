<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
    exit;
}

include '../config/db.php';
require_once '../device/zk_device.php';

$device = new ZKDevice();

if(isset($_POST['save'])){

    // AUTO UID
    $res = $conn->query("SELECT MAX(uid) as max_uid FROM cards");
    $row = $res->fetch_assoc();

    $uid = $row['max_uid'] ? $row['max_uid'] + 1 : 1;

    $flat = $_POST['flat_number'];
    $name = $_POST['name'];
    $card = $_POST['card_number'];
    $vehicle = $_POST['vehicle_number'];

    // INSERT QUERY
    // $sql = "INSERT INTO cards 
    // (uid, flat_number, name, card_number, vehicle_number) 
    // VALUES 
    // ('$uid','$flat','$name','$card','$vehicle')";
// INSERT QUERY
$sql = "INSERT INTO cards 
(uid, flat_number, name, card_number, vehicle_number, status) 
VALUES 
('$uid','$flat','$name','$card','$vehicle','active')";
    if($conn->query($sql)){

        $device->addCard($uid, $flat, $name, $card);

        $success = "Card added successfully!";

    } else {

        $error = $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Card</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4>Add New Card</h4>
        </div>

        <div class="card-body">

            <?php if(isset($success)) { ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
            <?php } ?>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Flat Number</label>
                    <input type="text" 
                    name="flat_number" 
                    class="form-control" 
                    required>
                </div>

                <div class="mb-3">
                    <label>Resident Name</label>
                    <input type="text" 
                    name="name" 
                    class="form-control">
                </div>

                <div class="mb-3">
                    <label>Card Number</label>
                    <input type="text" 
                    name="card_number" 
                    class="form-control">
                </div>

                <div class="mb-3">
                    <label>Vehicle Number</label>
                    <input type="text" 
                    name="vehicle_number" 
                    class="form-control">
                </div>

                <button type="submit" 
                name="save" 
                class="btn btn-success">
                    Save Card
                </button>

                <a href="dashboard.php" 
                class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>