<?php
session_start();
include 'config/db.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users
    WHERE username='$username'
    AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        $_SESSION['admin'] = $user['username'];
        $_SESSION['role'] = $user['role'];
header("Location: admin/dashboard.php");
        exit;

    } else {

        $error = "Invalid login details";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parking System Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4f6f9;">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
 <div class="card shadow" style="width:350px;">

        <div class="card-header bg-primary text-white text-center">
            <h4>Parking System Login</h4>
        </div>

        <div class="card-body">

            <?php if(isset($error)){ ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100" name="login">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>