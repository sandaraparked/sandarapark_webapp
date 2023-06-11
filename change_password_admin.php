<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "user")
{
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "accounting")
{
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "security")
{
    session_destroy();
    header("location:login.php");
    exit();
}

include("navbar_sidebar_admin.php");
require "includes/dbhed.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RESPARKMAN - Change Password Admin</title>

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> 
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <div class="container2">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                    Change Password
                </div>
                <?php
                    error_reporting(0);
                    session_start();
                    
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<p class='warning_msg'>Fill in all fields!</p>";
                        }
                        elseif ($_GET["error"] == "passwordsdontmatch") {
                            echo "<p class='warning_msg'>Password doesn't match!</p>";
                        }
                        elseif ($_GET["error"] == "stmtfailed") {
                            echo "<p class='warning_msg'>Something went wrong, try again!</p>";
                        }
                        elseif ($_GET["error"] == "incorrectpassword") {
                            echo "<p class='warning_msg'>Password is incorrect!</p>";
                        }
                        elseif ($_GET["error"] == "none") {
                            $_SESSION['message'] = "Profile updated successfully"; 
                            header('location:profile_admin.php');
                        }
                    }
                ?>
                <form action="includes/change_password.inc.php" method="POST">
                    <input type="hidden" name="user_id" value="<?=$_SESSION["user_id"];?>">
                    <input type="hidden" name="user_type" value="<?=$_SESSION["user_type"];?>">
                    <div class="input-box1 col-md-3">
                        <label>Old/Current Password</label>
                        <br>
                        <input type="password" name="oc_password" id="oc_password" required>
                    </div>  
                    <div class="input-box1 col-md-3">
                        <label>New Password</label>
                        <br>
                        <input type="password" type="password" name="password" id="password" required>
                    </div>  
                    <div class="input-box1 col-md-3">
                        <label>Confirm Password</label>
                        <input type="password" type="password" name="c_password" id="c_password" required>
                    </div>
                    <div class="col-md-3">
                        <div class="button input-box">
                            <input type="submit" name="change_password-admin" value="Change Password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var password = document.getElementById("password"),
            confirm_password = document.getElementById("c_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

</body>
</html>