<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['username']))
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "employee")
{
    header("location:login.php");
    exit();
}

include "users_processing.php";
include("navbar_sidebar_admin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Payment System Control</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>
    <!--Main Content-->
    <div class="container1">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                    Parking Payment System
                </div>
                <?php
                    error_reporting(0);
                    session_start();
                    
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "nopassword") {
                            echo "<p class='warning_msg'>Please provide your password!</p>";
                        }
                        elseif ($_GET["error"] == "stmtfailed") {
                            echo "<p class='warning_msg'>Something went wrong, try again!</p>";
                        }
                        elseif ($_GET["error"] == "pwdincorrect") {
                            echo "<p class='warning_msg'>The password you provided is incorrect!</p>";
                        }
                        elseif ($_GET["error"] == "none") {
                            $_SESSION['message'] = "Status of payment system has been updated successfully"; 
                            header("location: dashboard_admin.php");
                        }
                    }
                ?>
                <div class="input-boxes1">
                                <form action="includes/payment_system.inc.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?=$_SESSION["user_id"];?>">
                                    <div class="input-box1">
                                        <label>Status:</label>
                                        <br>
                                        <select name="payment_status">
                                            <option value="" disabled>Select Status:</option>
                                            <option value="on" <?= $_SESSION['payment_system'] == 'on' ? 'selected':''?> >Enabled</option>
                                            <option value="off"<?= $_SESSION['payment_system'] == 'off' ? 'selected':''?> >Disabled</option>
                                        </select>
                                    </div>
                                    <div class="input-box1">
                                        <label>Password:</label>
                                        <br>
                                        <input type="password" name="password" placeholder="Please provide your password" required>
                                    </div>
                                    <div class="button input-box">
                                        <input type="submit" name="update_payment_system" value="Update System">
                                    </div>
                            
                        
                </div>
            </div>
        </div>
    </div>

</body>
</html>