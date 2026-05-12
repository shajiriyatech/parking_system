<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
    exit;
}

include '../config/db.php';
include 'layout.php';

$success = 0;
$failed = 0;

if(isset($_FILES['csv_file'])){

    $file = $_FILES['csv_file']['tmp_name'];

    $handle = fopen($file, "r");

    // Skip first row
    fgetcsv($handle);

    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){

        $uid = trim($data[0]);
        $flat = trim($data[1]);
        $name = trim($data[2]);
        $card = trim($data[3]);
        $vehicle = trim($data[4]);

        // Check duplicate card
        $check = $conn->query("SELECT id FROM cards WHERE card_number='$card'");

        if($check->num_rows == 0){

            $sql = "INSERT INTO cards
            (uid, flat_number, name, card_number, vehicle_number, status)
            VALUES
            ('$uid','$flat','$name','$card','$vehicle','active')";

            if($conn->query($sql)){
                $success++;
            } else {
                $failed++;
            }

        } else {

            $failed++;
        }
    }

    fclose($handle);
}
?>

<div class="content">

    <div class="topbar">
        <h2>Import Result</h2>
    </div>

    <div class="card-box">

        <div style="
        display:flex;
        gap:20px;
        flex-wrap:wrap;
        margin-bottom:30px;
        ">

            <div style="
            flex:1;
            min-width:250px;
            background:#eafaf1;
            padding:25px;
            border-radius:10px;
            border-left:6px solid #28a745;
            ">

                <h3 style="margin-bottom:10px;color:#28a745;">
                    Successful Imports
                </h3>

                <h1><?php echo $success; ?></h1>

            </div>

            <div style="
            flex:1;
            min-width:250px;
            background:#fff0f0;
            padding:25px;
            border-radius:10px;
            border-left:6px solid #dc3545;
            ">

                <h3 style="margin-bottom:10px;color:#dc3545;">
                    Failed / Duplicate
                </h3>

                <h1><?php echo $failed; ?></h1>

            </div>

        </div>

        <a href="dashboard.php" class=" my-btn my-btn-add">
            Back To Dashboard
        </a>

        <a href="import_cards.php" class=" my-btn my-btn-edit">
            Import More
        </a>

    </div>

</div>

<?php include 'footer.php'; ?>