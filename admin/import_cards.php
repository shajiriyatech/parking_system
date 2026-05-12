<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
    exit;
}

include '../config/db.php';
include 'layout.php';
?>

<div class="content">

    <div class="topbar">
        <h2>Bulk Import Cards</h2>
    </div>

    <div class="card-box">

        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px;">

            <div>
                <h3 style="margin-bottom:10px;">Upload Resident CSV File</h3>

                <p style="color:#666;line-height:28px;">
                    Required Columns:
                    <br>
                    <b>
                    uid, flat_number, name,
                    card_number, vehicle_number
                    </b>
                </p>
            </div>

            <div>
                <a href="../sample.csv" class="my-btn my-btn-edit">
                    Download Sample CSV
                </a>
            </div>

        </div>

        <hr style="margin:30px 0;opacity:0.2;">

        <form action="upload_process.php" method="POST" enctype="multipart/form-data">

            <div style="margin-bottom:25px;">

                <label style="font-weight:600;display:block;margin-bottom:10px;">
                    Select CSV File
                </label>

                <!-- <input type="file" name="csv_file" required
                style="
                width:100%;
                padding:14px;
                border:1px solid #ccc;
                border-radius:8px;
                background:#fff;
                "> -->
                <input type="file" name="csv_file" required
style="
width:100%;
padding:14px;
border:1px solid #ccc;
border-radius:8px;
background:#fff;
">

            </div>

            <button type="submit" class="my-btn my-btn-add">
                Upload & Import
            </button>

        </form>

    </div>

    <div class="card-box" style="margin-top:25px;">

        <h3 style="margin-bottom:20px;">Instructions</h3>

        <ul style="line-height:32px;color:#555;padding-left:20px;">

            <li>Prepare resident data in Excel</li>

            <li>Save file as CSV UTF-8</li>

            <li>Upload CSV using this page</li>

            <li>Duplicate card numbers are skipped automatically</li>

            <li>New cards are added as ACTIVE by default</li>

        </ul>

    </div>

</div>

<?php include 'footer.php'; ?>