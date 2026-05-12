<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Parking System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}
.sidebar{
    width:250px;
    height:100vh;
    background:#1e293b;
    position:fixed;
    left:0;
    top:0;
    padding-top:20px;
}

.sidebar h3{
    color:white;
    text-align:center;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:#cbd5e1;
    padding:15px 20px;
    text-decoration:none;
}

.sidebar a:hover{
    background:#334155;
     color:white;
}

.main{
    margin-left:250px;
    padding:20px;
}

.topbar{
    background:white;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}
.btn{
    display:inline-block;
    padding:10px 20px;
    border:none;
    border-radius:8px;
    text-decoration:none;
    color:#fff;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
   
}

 .btn:hover{
    
    transform:translateY(-1px);
    
} 

.btn-add{
    background:#0d6efd;
}

.btn-edit{
    background:#6c757d;
}

.btn-delete{
    background:#dc3545;
}

.file-input{
    width:100%;
    padding:10px;
    border:1px ;
    border-radius:8px;
    background:#fff;
    font-size:14px;
}
.my-btn{
    display:inline-block;
    padding:12px 22px;
    border-radius:8px;
    text-decoration:none;
    color:#fff;
    font-weight:600;
    border:none;
    cursor:pointer;
    transition:0.3s;
}

.my-btn:hover{
    color:#fff;
    transform:translateY(-1px);
}

.my-btn-add{
    background:#0d6efd;
}

.my-btn-add:hover{
    background:#0b5ed7;
}

.my-btn-edit{
    background:#6c757d;
}

.my-btn-edit:hover{
    background:#5c636a;
}
/* .file-input:hover{
    border: color #0d6efd;
} */
</style>

</head>

<body>

<div class="sidebar">

<h3>Parking System</h3>
<a href="dashboard.php">Dashboard</a>


<?php if($_SESSION['role'] != 'security'){ ?>

    <a href="add_card.php">Add Card</a>
     <a href="import_cards.php">Bulk Import</a>

<?php } ?>

<a href="logout.php">Logout</a>

</div>

<div class="main">