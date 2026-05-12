<?php
include '../config/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM cards WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){
    $flat = $_POST['flat_number'];
    $name = $_POST['name'];
    $card = $_POST['card_number'];
    $vehicle = $_POST['vehicle_number'];

    $conn->query("UPDATE cards SET 
        flat_number='$flat',
        name='$name',
        card_number='$card',
        vehicle_number='$vehicle'
        WHERE id=$id");

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h3>Edit Card</h3> 
 
            
<form method="POST">
    <label>Flat Number</label>
    <input class="form-control mb-3" name="flat_number" value="<?php echo $data['flat_number']; ?>">
    <label>Resident Name</label>
    <input class="form-control mb-3" name="name" value="<?php echo $data['name']; ?>">
    <label>Card Number</label>
    <input class="form-control mb-3" name="card_number" value="<?php echo $data['card_number']; ?>">
    <label>Vehicle Number</label>
    <input class="form-control mb-3" name="vehicle_number" value="<?php echo $data['vehicle_number']; ?>">

    <button name="update" class="btn btn-success">Update</button>
</form>

</body>
</html>