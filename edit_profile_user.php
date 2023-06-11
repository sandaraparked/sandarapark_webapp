<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
    header("location:login.php");
    exit();
}
elseif($_SESSION['user_type'] === "admin")
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

include('navbar_sidebar_user.php');
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

    <title>RESPARKMAN - Edit User Profile Information</title>

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
    <div class="container2">
        <div class="forms">
            <div class="form-content">
                <div class="title">
                    Edit Profile
                </div>
                <?php
                    error_reporting(0);
                    session_start();
                    
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<p class='warning_msg'>Fill in all fields!</p>";
                            
                        }
                        else if ($_GET["error"] == "invalidusername") {
                            echo "<p class='warning_msg'>Please input a proper username!</p>";
                        }
                        else if ($_GET["error"] == "invalidemail") {
                            echo "<p class='warning_msg'>Please input a proper email!</p>";
                        }
                        elseif ($_GET["error"] == "passwordsdontmatch") {
                            echo "<p class='warning_msg'>Password doesn't match!</p>";
                        }
                        elseif ($_GET["error"] == "stmtfailed") {
                            echo "<p class='warning_msg'>Something went wrong, try again!</p>";
                        }
                        elseif ($_GET["error"] == "none") {
                            $_SESSION['message'] = "Profile information updated successfully"; 
                            header('location:profile-user.php');
                            exit(0);
                        }
                    }
                ?>
                <div class="input-boxes1">
                                <form action="includes/edit_profile_user.inc.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?=$_SESSION["user_id"]?>">
                                    <input type="hidden" name="email" value="<?=$_SESSION["email"];?>">
                                    <input type="hidden" name="user_type" value="<?=$_SESSION["user_type"]?>">
                                    <div class="input-box1 col-sm-3">
                                        <label>Name (FN MI. LN)</label>
                                        <br>
                                        <input type="text" name="name" value="<?=$_SESSION["name"];?>">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Username</label>
                                        <br>
                                        <input type="text" name="username" value="<?=$_SESSION["username"];?>">
                                    </div>
                                    <div class="input-box1 col-sm-3">
                                        <label>Plate Number</label>
                                        <br>
                                        <input type="text" name="plate_num" value="<?=$_SESSION["plate_num"];?>">
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="button input-box">
                                            <input type="submit" name="update_profile-user" value="Update Profile">
                                        </div>
                                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>